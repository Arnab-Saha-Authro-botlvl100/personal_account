<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Service;
use App\Models\Receive;
use App\Models\Customer;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Agent;
use App\Models\Supplier;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function statement()
    {
        // Get all bank transactions first
        $bankTransactions = Transaction::where('is_delete', 0)
            ->where('user', Auth::id())
            ->where('transaction_type', 'bank')
            ->get();
    
        // Get all cash transactions directly
        $cashTransactions = Transaction::where('is_delete', 0)
            ->where('user', Auth::id())
            ->where('transaction_type', 'cash')
            ->get();
    
        // Get all bank transaction IDs
        $bankIds = $bankTransactions->pluck('id')->toArray();
        
        // Get total receive amounts
        $receives = Receive::where('transaction_method', 'bank')
            ->whereIn('bank_name', $bankIds)
            ->groupBy('bank_name')
            ->selectRaw('bank_name, SUM(amount) as total_receive')
            ->pluck('total_receive', 'bank_name');
    
        // Get total payment amounts
        $payments = Payment::where('transaction_method', 'bank')
            ->whereIn('bank_name', $bankIds)
            ->groupBy('bank_name')
            ->selectRaw('bank_name, SUM(amount) as total_payment')
            ->pluck('total_payment', 'bank_name');
    
        // Attach totals and balance to bank transactions
        foreach ($bankTransactions as $transaction) {
            $transaction->total_receive = $receives[$transaction->id] ?? 0;
            $transaction->total_payment = $payments[$transaction->id] ?? 0;
            $transaction->balance = $transaction->opening_balance + $transaction->total_receive - $transaction->total_payment;
        }
        // Attach totals and balance to bank transactions
        foreach ($cashTransactions as $transaction) {
            $transaction->total_receive = Receive::where('transaction_method', 'cash')->where('user', Auth::id())->sum('amount');
            $transaction->total_payment = Payment::where('transaction_method', 'cash')->where('user', Auth::id())->sum('amount');
            $transaction->balance = $transaction->opening_balance + $transaction->total_receive - $transaction->total_payment;
        }
        // dd($cashTransactions);
    
        return view('reports.statement', compact('bankTransactions', 'cashTransactions'));
    }
    

    public function general_ledger(){
        // Fetch data from each table
        $customers = Customer::where('user', Auth::id())->where('is_delete', 0)->get();
        $agents = Agent::where('user', Auth::id())->where('is_delete', 0)->where('is_active', 1)->get();
        $suppliers = Supplier::where('user', Auth::id())->where('is_delete', 0)->where('is_active', 1)->get();
        
        $receives = Receive::where('receives.user', Auth::id())
            ->leftJoin('transactions', 'receives.bank_name', '=', 'transactions.id')
            ->select('receives.*', 'transactions.bank_name as transaction_bank_name')
            ->get();

        // Fetch payments with a left join on transactions
        $payments = Payment::where('payments.user', Auth::id())
            ->leftJoin('transactions', 'payments.bank_name', '=', 'transactions.id')
            ->select('payments.*', 'transactions.bank_name as transaction_bank_name')
            ->get();

        $tickets = Ticket::where('tickets.user', Auth::id())
            ->where('tickets.is_delete', 0)
            ->leftJoin('customers', 'tickets.customer_id', '=', 'customers.id')
            ->select('tickets.*', 'customers.name as customer_name', 'customers.agent_contract as debit', 'customers.supplier_contract as credit') // Select customer name
            ->get(); 

        $contracts = Contract::where('contracts.user', Auth::id())
            ->leftJoin('agents', 'contracts.agent', '=', 'agents.id')
            ->leftJoin('suppliers', 'contracts.supplier', '=', 'suppliers.id')
            ->leftJoin('customers', 'contracts.customer_id', '=', 'customers.id')
            ->select(
                'contracts.*',
                'agents.name as agent_name',
                'suppliers.name as supplier_name',
                'customers.name as customer_name'
            )
            ->get();    
        // Concatenate all collections
        $merged = collect() // Start with an empty collection
            // ->concat($customers)
            ->concat($receives)
            ->concat($payments)
            ->concat($tickets)
            ->concat($contracts);
    
        // Sort the merged collection by 'created_at'
        $sorted = $merged->sortBy('created_at');
    
        // If you need to reset the keys (optional)
        $sorted = $sorted->values();
    
        // dd($sorted);
        // Return or process the sorted collection
        return view('reports.general_ledger', compact('sorted', 'customers', 'agents', 'suppliers'));
    }

    
    public function general_ledger_modified(Request $request)
    {
        // Validate request inputs
        $request->validate([
            'customer' => 'nullable|integer|exists:customers,id',
            'agent' => 'nullable|integer|exists:agents,id',
            'supplier' => 'nullable|integer|exists:suppliers,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);
    
        // Convert dates into MySQL-compatible format, or set null if not provided
        $start_date = $request->filled('start_date') ? Carbon::parse($request->start_date)->format('Y-m-d') : null;
        $end_date = $request->filled('end_date') ? Carbon::parse($request->end_date)->format('Y-m-d') : null;
    
        // Initialize collections
        $receives = collect();
        $payments = collect();
        $tickets = collect();
        $contracts = collect();
        $customers = collect();
    
        if ($request->filled('customer')) {
            // If a specific customer is provided, fetch only that customer
            $customers = Customer::where('id', $request->customer)->get();
            $receives = Receive::where('customer_id', $request->customer);
            $payments = Payment::where('customer_id', $request->customer);
            $tickets = Ticket::where('customer_id', $request->customer);
            $contracts = Contract::where('customer_id', $request->customer);
        } else {
            // dd($request->all());
            // Query customers based on agent and/or supplier
            $customerQuery = Customer::where('is_delete', 0)
                ->where('is_active', 1)
                ->where('user', Auth::id());
            // dd($customerQuery);
    
            if ($request->filled('agent') && !$request->filled('supplier')) {
                // dd('agent');
                $customerQuery->where('agent', $request->agent);
            }
    
            if ($request->filled('supplier') && !$request->filled('agent')) {
                // dd('supplier');
                $customerQuery->where('supplier', $request->supplier);
            }
    
            if ($request->filled('agent') && $request->filled('supplier')) {
                // dd('both');
                $customerQuery->where('agent', $request->agent)
                    ->where('supplier', $request->supplier);
            }
    
            // Retrieve full customer collection
            $customers = $customerQuery->get();
            $customerIds = $customers->pluck('id');

            // dd($customers);
            // Query related records for those customers
            $receives = Receive::whereIn('customer_id', $customerIds);
            $payments = Payment::whereIn('customer_id', $customerIds);
            $tickets = Ticket::whereIn('customer_id', $customerIds);
            $contracts = Contract::whereIn('customer_id', $customerIds);

        }
    
        // Apply date filters if provided
        if ($start_date) {
            $receives->whereDate('date', '>=', $start_date);
            $payments->whereDate('date', '>=', $start_date);
            $tickets->whereDate('flight_date', '>=', $start_date);
            $contracts->whereDate('date', '>=', $start_date);
        }
    
        if ($end_date) {
            $receives->whereDate('date', '<=', $end_date);
            $payments->whereDate('date', '<=', $end_date);
            $tickets->whereDate('flight_date', '<=', $end_date);
            $contracts->whereDate('date', '<=', $end_date);
        }
        
        $receives = $receives->where('receives.user', Auth::id())
            ->leftJoin('transactions', 'receives.bank_name', '=', 'transactions.id')
            ->select('receives.*', 'transactions.bank_name as transaction_bank_name')
            ->get();

        $payments = $payments->where('payments.user', Auth::id())
            ->leftJoin('transactions', 'payments.bank_name', '=', 'transactions.id')
            ->select('payments.*', 'transactions.bank_name as transaction_bank_name')
            ->get();

        $tickets = Ticket::where('tickets.user', Auth::id())
            ->where('tickets.is_delete', 0)
            ->when($request->filled('customer'), function ($query) use ($request) {
                return $query->where('tickets.customer_id', $request->customer);
            })
            ->when($request->filled('agent'), function ($query) use ($request) {
                return $query->where('customers.agent', $request->agent);
            })
            ->when($request->filled('supplier'), function ($query) use ($request) {
                return $query->where('customers.supplier', $request->supplier);
            })
            ->leftJoin('customers', 'tickets.customer_id', '=', 'customers.id')
            ->select(
                'tickets.*',
                'customers.name as customer_name',
                'customers.agent_contract as debit',
                'customers.supplier_contract as credit'
            )
            ->get();
        
        

        $contracts = Contract::where('contracts.user', Auth::id())
            ->when($request->filled('customer'), function ($query) use ($request) {
                return $query->where('contracts.customer_id', $request->customer);
            })
            ->when($request->filled('agent'), function ($query) use ($request) {
                return $query->where('contracts.agent', $request->agent);
            })
            ->when($request->filled('supplier'), function ($query) use ($request) {
                return $query->where('contracts.supplier', $request->supplier);
            })
            ->leftJoin('agents', 'contracts.agent', '=', 'agents.id')
            ->leftJoin('suppliers', 'contracts.supplier', '=', 'suppliers.id')
            ->leftJoin('customers', 'contracts.customer_id', '=', 'customers.id')
            ->select(
                'contracts.*',
                'agents.name as agent_name',
                'suppliers.name as supplier_name',
                'customers.name as customer_name'
            )
            ->get();
        
        


         // Concatenate all collections
        $merged = collect() // Start with an empty collection
        //  ->concat($customers)
         ->concat($receives)
         ->concat($payments)
         ->concat($tickets)
         ->concat($contracts);
 
        // Sort the merged collection by 'created_at'
        $sorted = $merged->sortBy('created_at');
    
        // If you need to reset the keys (optional)
        $sorted = $sorted->values();
    
        // dd($sorted);
        $htmlpart = ViewFacade::make('reports.report', [
            'sorted' => $sorted,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ])->render();

        return response()->json(['html' => $htmlpart]);
        
    }

    public function cashbook(){
        return view('reports.cashbook');
    }

    // public function cashbook_report(Request $request)
    // {
    //     if (Auth::user()) {
    //         // Get the start and end dates
    //         $start_date = $request->input('start_date') ?? null;
    //         $end_date = $request->input('end_date') ?? null;

    //         // Convert start_date and end_date to DateTime objects if they are provided
    //         if ($start_date) {
    //             $start_date = (new DateTime($start_date))->format('Y-m-d');
    //         }

    //         if ($end_date) {
    //             $end_date = (new DateTime($end_date))->format('Y-m-d');
    //         }

    //         // Get the authenticated user ID
    //         $user = Auth::id();

    //         // Initialize query builders for each model
    //         $receives = Receive::where('user', $user);
    //         $payments = Payment::where('user', $user);

    //         // Apply date-wise search if start_date and end_date are available
    //         if ($start_date && $end_date) {
    //             $receives->whereBetween('date', [$start_date, $end_date]);
    //             $payments->whereBetween('date', [$start_date, $end_date]);
    //         } elseif ($start_date) {
    //             // Apply only start_date filter if available
    //             $receives->where('date', '>=', $start_date);
    //             $payments->where('date', '>=', $start_date);
    //         } elseif ($end_date) {
    //             // Apply only end_date filter if available
    //             $receives->where('date', '<=', $end_date);
    //             $payments->where('date', '<=', $end_date);
    //         }

    //         // Execute queries to retrieve data
    //         $receivesData = $receives->get();
    //         $paymentsData = $payments->get();

    //         // Merge and sort data by date
    //         $mergedData = $receivesData->concat($paymentsData)->sortBy('date');

    //         // Initialize totals
    //         $totals = [];
    //         $totalDebit = 0;
    //         $totalCredit = 0;

    //         // Process mergedData
    //         foreach ($mergedData as $transaction) {
    //             $methodName = $transaction->transaction_method == 'cash' ? 'cash' : $this->getBankName($transaction->bank_name);
    //             if ($transaction instanceof Receive) {
    //                 $totals[$methodName]['debit'] = ($totals[$methodName]['debit'] ?? 0) + $transaction->amount;
    //                 $totalDebit += $transaction->amount;
    //             } elseif ($transaction instanceof Payment) {
    //                 $totals[$methodName]['credit'] = ($totals[$methodName]['credit'] ?? 0) + $transaction->amount;
    //                 $totalCredit += $transaction->amount;
    //             }
    //         }

    //         // Render the report view with the gathered data
    //         $html = ViewFacade::make('reports.cashbook_report', [
    //             'start_date' => $start_date,
    //             'end_date' => $end_date,
    //             'mergedData' => $mergedData,
    //             'totals' => $totals,
    //             'totalDebit' => $totalDebit,
    //             'totalCredit' => $totalCredit,
    //             'getBankName' => [$this, 'getBankName'], // Pass the method as a callable
    //         ])->render();

    //         return response()->json(['html' => $html]);
    //     } else {
    //         return view('welcome');
    //     }
    // }
    public function cashbook_report(Request $request)
    {
        if (Auth::user()) {
            // Get the start and end dates
            $start_date = $request->input('start_date') ?? null;
            $end_date = $request->input('end_date') ?? null;

            // Convert start_date and end_date to Y-m-d format
            if ($start_date) {
                $start_date = (new DateTime($start_date))->format('Y-m-d');
            }

            if ($end_date) {
                $end_date = (new DateTime($end_date))->format('Y-m-d');
            }

            // Get authenticated user ID
            $user = Auth::id();

            // Calculate opening balances (transactions before start_date)
            $opening_balance_receive = Receive::where('user', $user)
                ->where('date', '<', $start_date)
                ->sum('amount');

            $opening_balance_payment = Payment::where('user', $user)
                ->where('date', '<', $start_date)
                ->sum('amount');

            $opening_balance = $opening_balance_receive - $opening_balance_payment;

            // Query transactions within the selected date range
            $receives = Receive::where('user', $user);
            $payments = Payment::where('user', $user);

            if ($start_date && $end_date) {
                $receives->whereBetween('date', [$start_date, $end_date]);
                $payments->whereBetween('date', [$start_date, $end_date]);
            } elseif ($start_date) {
                $receives->where('date', '>=', $start_date);
                $payments->where('date', '>=', $start_date);
            } elseif ($end_date) {
                $receives->where('date', '<=', $end_date);
                $payments->where('date', '<=', $end_date);
            }

            // Get transaction data
            $receivesData = $receives->get();
            $paymentsData = $payments->get();

            // Merge and sort transactions by date
            $mergedData = $receivesData->concat($paymentsData)->sortBy('date');

            // Initialize totals
            $totals = [];
            $totalDebit = 0;
            $totalCredit = 0;

            // Process merged transactions
            foreach ($mergedData as $transaction) {
                $methodName = $transaction->transaction_method == 'cash' ? 'cash' : $this->getBankName($transaction->bank_name);
                if ($transaction instanceof Receive) {
                    $totals[$methodName]['debit'] = ($totals[$methodName]['debit'] ?? 0) + $transaction->amount;
                    $totalDebit += $transaction->amount;
                } elseif ($transaction instanceof Payment) {
                    $totals[$methodName]['credit'] = ($totals[$methodName]['credit'] ?? 0) + $transaction->amount;
                    $totalCredit += $transaction->amount;
                }
            }

            // Render the report view with all data
            $html = ViewFacade::make('reports.cashbook_report', [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'mergedData' => $mergedData,
                'totals' => $totals,
                'totalDebit' => $totalDebit,
                'totalCredit' => $totalCredit,
                'opening_balance' => $opening_balance,
                'getBankName' => [$this, 'getBankName'], // Pass callable method
                'getBankDetails' => [$this, 'getBankDetails'], // Pass callable method
            ])->render();

            return response()->json(['html' => $html]);
        } else {
            return redirect()->route('register');
        }
    }

    public function getBankName($bankId)
    {
        $bank = Transaction::where('id', $bankId)->first();
        return $bank ? $bank->bank_name : 'Unknown Bank';
    }

    public function getBankDetails($bankId)
    {
        $bank = Transaction::where('id', $bankId)->first();
    
        if ($bank) {
            return [
                'bank_name' => $bank->bank_name,
                'account_number' => $bank->account_number,
                'branch_name' => $bank->branch_name
            ];
        }
    
        return [
            'bank_name' => 'Unknown Bank',
            'account_number' => 'Unknown Account',
            'branch_name' => 'Unknown Branch'
        ];
    }

    public function receive_payment(){
        $agents = Agent::where('user', Auth::id())->where('is_delete', 0)->where('is_active', 1)->get();
        $suppliers = Supplier::where('user', Auth::id())->where('is_delete', 0)->where('is_active', 1)->get();
        
        return view('reports.receive_payment', compact('agents', 'suppliers'));
    }

    public function receive_payment_report(Request $request){
        if (Auth::user()) {
            // Get the start and end dates
            $start_date = $request->input('start_date') ?? null;
            $end_date = $request->input('end_date') ?? null;

            // Convert start_date and end_date to DateTime objects if they are provided
            if ($start_date) {
                $start_date = (new DateTime($start_date))->format('Y-m-d');
            }

            if ($end_date) {
                $end_date = (new DateTime($end_date))->format('Y-m-d');
            }

            // Get the authenticated user ID
            $user = Auth::id();
            $type = $request->input('type');
            $id = null;
            $opening_balance = null;
            if ($type == 'agent') {
                $id = $request->input('agent_id');
                $opening_balance = DB::table('previous_dues')->where('agent_id', $id)->value('amount');
            } else if ($type == 'supplier') {
                $id = $request->input('supplier_id');
                $opening_balance = DB::table('previous_dues')->where('supplier_id', $id)->value('amount');

            }

            // Initialize query builders for each model
            $receives = Receive::where('receives.user', $user)
                ->join('customers', 'receives.customer_id', '=', 'customers.id');

            $payments = Payment::where('payments.user', $user)
                ->join('customers', 'payments.customer_id', '=', 'customers.id');

            // Apply agent/supplier filter if type and id are provided
            if ($type && $id) {
                if ($type == 'agent') {
                    $receives->where('customers.agent', $id);
                    $payments->where('customers.agent', $id);
                } else if ($type == 'supplier') {
                    $receives->where('customers.supplier', $id);
                    $payments->where('customers.supplier', $id);
                }
            }

            // Apply date-wise search if start_date and end_date are available
            if ($start_date && $end_date) {
                $receives->whereBetween('receives.date', [$start_date, $end_date]);
                $payments->whereBetween('payments.date', [$start_date, $end_date]);
            } elseif ($start_date) {
                // Apply only start_date filter if available
                $receives->where('receives.date', '>=', $start_date);
                $payments->where('payments.date', '>=', $start_date);
            } elseif ($end_date) {
                // Apply only end_date filter if available
                $receives->where('receives.date', '<=', $end_date);
                $payments->where('payments.date', '<=', $end_date);
            }

            // Execute queries to retrieve data
            $receivesData = $receives->get();
            $paymentsData = $payments->get();

            // Calculate totals (example logic, adjust as needed)
            $totalDebit = $receivesData->sum('amount');
            $totalCredit = $paymentsData->sum('amount');

            // dd($receivesData, $paymentsData);
            // Render the report view with the gathered data
            $html = ViewFacade::make('reports.receive_payment_report', [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'type' => $type,
                'opening_balance' => $opening_balance,
                'receivesData' => $receivesData,
                'paymentsData' => $paymentsData,
                'totalDebit' => $totalDebit,
                'totalCredit' => $totalCredit,
            ])->render();

            return response()->json(['html' => $html]);
        } else {
            return view('welcome');
        }
    }

    
    public function details_agent() {
        // Get agents and join with previous_dues to fetch the amount
        $agents = Agent::where([
                ['is_delete', 0],
                ['is_active', 1],
                ['agents.user', Auth::id()]
            ])
            ->leftJoin('previous_dues', 'agents.id', '=', 'previous_dues.agent_id')
            ->select('agents.*', 'previous_dues.amount as opening_balance') // Select all agent columns and the opening_balance
            ->orderBy('agents.created_at', 'desc')
            ->get();
    
        // Return view with agents data including their opening balance from previous_dues
        return view('details.agent', compact('agents'));
    }
    
    public function details_supplier() {
        $suppliers = Supplier::select('suppliers.*', DB::raw('COALESCE(previous_dues.amount, 0) as opening_balance'))
            ->leftJoin('previous_dues', 'previous_dues.supplier_id', '=', 'suppliers.id')  // Join with previous_dues table
            ->where([
                ['suppliers.is_delete', 0],
                ['suppliers.is_active', 1],
                ['suppliers.user', Auth::id()]
            ])
            ->orderBy('suppliers.created_at', 'desc')
            ->get();
    
        return view('details.supplier', compact('suppliers'));
    }
    
    public function details_transaction(){
        $transactions = Transaction::where([
            ['is_delete', 0],
            ['user', Auth::id()]
        ])->orderBy('created_at', 'desc')->get();
        return view('details.transaction', compact('transactions'));
    }
    public function details_service(){
        $services = Service::where([
            ['is_delete', 0],
            ['user', Auth::id()]
        ])->orderBy('created_at', 'desc')->get();
        return view('details.service', compact('services'));
    }

}
