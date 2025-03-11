<?php

namespace App\Http\Controllers;

use App\Models\Receive;
use App\Models\Transaction;
use App\Models\Customer; // Assuming you have a Customer model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiveController extends Controller
{
    // Show the form for creating a new receive transaction
    public function create()
    {
        $customers = Customer::all(); // Fetch all customers
        return view('receives.create', compact('customers')); // Adjust the view path as needed
    }

    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'date' => 'required|date',
    //         'receive_type' => 'required|in:customer,others',
    //         'customer_id' => 'nullable|exists:customers,id',
    //         'customer_name' => 'nullable|string|max:255',
    //         'contract_invoice' => 'nullable|string|max:255',
    //         'receive_amount' => 'nullable|string|max:255',
    //         'transaction_method' => 'required|in:cash,bank',
    //         'bank_name' => 'nullable|string|max:255',
    //         'account_number' => 'nullable|string|max:20',
    //         'branch_name' => 'nullable|string|max:255',
    //         'amount' => 'required|numeric|min:0',
    //         'note' => 'nullable|string|max:500',
    //     ]);
    
    //     // Add authenticated user's ID
    //     $request->merge(['user' => Auth::id()]);
    
    //     try {
    //         // Create the receive transaction
    //         Receive::create($request->all());
    
    //         return redirect()->route('receives.index')->with('success', 'Transaction received successfully.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Failed to receive. Please try again. ' . $e->getMessage());
    //     }
    // }
    
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'date' => 'required|date',
            'receive_type' => 'required|in:customer,others',
            'customer_id' => 'nullable|exists:customers,id',
            'customer_name' => 'nullable|string|max:255',
            'contract_invoice' => 'nullable|string|max:255',
            'receive_amount' => 'nullable|string|max:255',
            'transaction_method' => 'required|in:cash,bank',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:20',
            'branch_name' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:500',
        ]);
    
        // Get customer ID and new payment amount
        $customerId = $request->customer_id;
        $newReceiveAmount = $request->amount;
        $agentContact = 0;
        $totalPaid = $newTotalPaid = 0;
    
        if ($customerId) {
            // Get total amount paid by this customer
            $totalPaid = Receive::where('customer_id', $customerId)->sum('amount');
    
            // Get customer's agent contract amount
            $customer = Customer::find($customerId);
            if (!$customer) {
                return response()->json(['status' => 'error', 'message' => 'Customer not found.'], 404);
            }
    
            $agentContact = $customer->agent_contract;
            $newTotalPaid = $totalPaid + $newReceiveAmount;
    
            // Check if new total paid exceeds agent contract
            if ($newTotalPaid > $agentContact) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Receive exceeds agent contract. Remaining balance: ' . number_format($agentContact - $totalPaid, 2) . ' BDT'
                ], 400);
            }
        } else {
            $newTotalPaid = $newReceiveAmount;
        }
    
        // Add authenticated user's ID
        $request->merge(['user' => Auth::id()]);
    
        try {
            // Create the receive transaction
            $receive = Receive::create($request->all());
            
            // Generate clipboard text based on receive_type
            if ($request->receive_type === 'customer' && $customerId) {
                $clipboardText = [
                    'Customer' => $customer->name,
                    'Total Paid' => "{$newTotalPaid} BDT",
                    'Contract Amount' => "{$agentContact} BDT",
                    'Due Amount' => number_format($agentContact - $newTotalPaid, 2) . " BDT"
                ];
            } else {
                $clipboardText = [
                    'Received Amount' => "{$newReceiveAmount} BDT",
                    'Note' => $request->note ?? 'N/A'
                ];
            }
    
            // Convert clipboard text to JSON
            $clipboardTextJson = json_encode($clipboardText);
    
            // Return success response with clipboard text
            return response()->json([
                'status' => 'success',
                'message' => 'Transaction received successfully.',
                'clipboard_text' => $clipboardTextJson,
                'redirect_url' => $request->receive_type === 'others' 
                    ? route('receives.index')
                    : route('receives.receipt', ['customer_id' => $customerId, 'receive_id' => $receive->id])
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to receive. Please try again. ' . $e->getMessage()
            ], 500);
        }
    }
    
    // Display a listing of the receives
    public function index()
    {
        // $receives = Receive::all(); // Fetch all receive transactions
        $receives = Receive::where('user', Auth::id())
            ->orderBy('created_at', 'DESC') // Correct case
            ->get();
            
        $customers = Customer::where('customers.user', Auth::id())
                    ->where('customers.is_delete', 0)
                    ->where('customers.is_active', 1)
                    ->join('contracts', 'customers.contract_id', '=', 'contracts.id')
                    ->join('agents', 'customers.agent', '=', 'agents.id')
                    ->select('customers.name', 'customers.customer_id','customers.id', 'contracts.invoice_no', 'customers.agent_contract', 'agents.name as agent_name')
                    ->get();
        $banks = Transaction::where([
                        ['is_delete', 0],
                        ['transaction_type', 'bank'],
                        ['user', Auth::id()]
                    ])->get();
        // dd($receives);
        return view('receives.index', compact('receives', 'customers', 'banks')); // Adjust the view path as needed
    }

    // Show the form for editing the specified receive transaction
    public function edit(Receive $receive)
    {
        $customers = Customer::all(); // Fetch all customers
        return view('receives.edit', compact('receive', 'customers')); // Adjust the view path as needed
    }

    // Update the specified receive transaction in storage
    public function update(Request $request, Receive $receive)
    {
        // Validate the request
        $request->validate([
            'date' => 'required|date',
            'receive_type' => 'required|in:customer,others',
            'customer_id' => 'nullable|exists:customers,id',
            'customer_name' => 'nullable|string|max:255',
            'contract_invoice' => 'nullable|string|max:255',
            'agent_contract' => 'nullable|string|max:255',
            'transaction_method' => 'required|in:cash,bank',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:20',
            'branch_name' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:500',
        ]);

        // Update the receive transaction
        $receive->update($request->all());

        return redirect()->route('receives.index')->with('success', 'Transaction updated successfully.');
    }

    // Remove the specified receive transaction from storage
    public function destroy(Receive $receive)
    {
        $receive->delete();
        return redirect()->route('receives.index')->with('success', 'Transaction deleted successfully.');
    }

    
    public function getDueAmount($customer_id)
    {
        // Fetch the total amount paid by the customer
        $totalPaid = Receive::where('customer_id', $customer_id)->sum('amount');
    
        // Fetch the customer details
        $customer = Customer::find($customer_id);
    
        // Check if the customer exists
        if (!$customer) {
            return response()->json([
                'error' => 'Customer not found',
            ], 404);
        }
    
        // Fetch the supplier contract amount
        $agentContact = $customer->agent_contract;
    
        // Calculate the due amount
        $dueAmount = $agentContact - $totalPaid;
    
        // Format the due amount to 2 decimal places
        $formattedDueAmount = number_format($dueAmount, 2);
    
        // Return the due amount as a JSON response
        return response()->json([
            'due_amount' => $formattedDueAmount,
        ]);
    }

    public function receipt($customer_id, $receive_id){
        
        // Fetch customer details
        $customer = Customer::findOrFail($customer_id);

        // Get the latest payment for the customer
        $latestReceive = Receive::where('customer_id', $customer_id)->latest()->first();

        // Get the total paid amount by the customer
        $totalPaid = Receive::where('customer_id', $customer_id)->sum('amount');

        // Calculate the remaining amount
        $remaining = (int) $customer->agent_contract - $totalPaid;

        return view('receives.receipt', compact('customer', 'latestReceive', 'totalPaid', 'remaining'));
    }
}