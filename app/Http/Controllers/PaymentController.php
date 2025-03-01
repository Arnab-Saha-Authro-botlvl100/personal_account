<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Customer; // Assuming you have a Customer model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
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
        $newPaymentAmount = $request->amount;
        $supplierContract = $newTotalPaid = 0;
        if ($customerId) {
            // Get total amount paid by this customer
            $totalPaid = Payment::where('customer_id', $customerId)->sum('amount');

            // Get customer's supplier contract amount
            $customer = Customer::find($customerId);
            if (!$customer) {
                return redirect()->back()->with('error', 'Customer not found.');
            }

            $supplierContract = $customer->supplier_contract;
            $newTotalPaid = $totalPaid + $newPaymentAmount;

            // Check if new total paid exceeds supplier contract
            if ($newTotalPaid > $supplierContract) {
                return redirect()->back()->with('error', 'Payment exceeds supplier contract. Remaining balance: ' . number_format($supplierContract - $totalPaid, 2) . ' BDT');
            }
        }
        else{
            $newTotalPaid = $newPaymentAmount;
        }

        // Add authenticated user's ID
        $request->merge(['user' => Auth::id()]);

        try {
            // Create the payment transaction
            $payment = Payment::create($request->all());

             // Prepare clipboard text
            $clipboardText = "Contract: $supplierContract\nTotal Paid Amount: $newTotalPaid\nDue: " . ($supplierContract - $newTotalPaid);

             // Store clipboard text in session
            session()->flash('clipboard_text', $clipboardText);
            // Redirect to receipt page with customer_id and payment_id
            if($request->receive_type === 'others'){
                return redirect()->route('payments.index')->with('success', 'Payment transaction successfully created');
            }
            return redirect()->route('payments.receipt', ['customer_id' => $customerId, 'payment_id' => $payment->id])
                ->with('success', 'Payment received successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to receive payment. Please try again. ' . $e->getMessage());
        }
    }


    // Display a listing of the receives
    public function index()
    {
        $payments = Payment::where('user', Auth::id())
            ->orderBy('created_at', 'DESC') // Correct case
            ->get();
        $customers = Customer::where('customers.user', Auth::id())
                    ->where('customers.is_delete', 0)
                    ->where('customers.is_active', 1)
                    ->join('contracts', 'customers.contract_id', '=', 'contracts.id')
                    ->join('suppliers', 'customers.supplier', '=', 'suppliers.id')
                    ->select('customers.name', 'customers.customer_id','customers.id', 'contracts.invoice_no', 'customers.supplier_contract', 'suppliers.name as supplier_name')
                    ->get();
        $banks = Transaction::where([
                        ['is_delete', 0],
                        ['transaction_type', 'bank'],
                        ['user', Auth::id()]
                    ])->get();
        // dd($customers);
        return view('payments.index', compact('payments', 'customers', 'banks')); // Adjust the view path as needed
    }

    public function receipt($customer_id, $payment_id)
    {
        // Fetch customer details
        $customer = Customer::findOrFail($customer_id);

        // Get the latest payment for the customer
        $latestPayment = Payment::where('customer_id', $customer_id)->latest()->first();

        // Get the total paid amount by the customer
        $totalPaid = Payment::where('customer_id', $customer_id)->sum('amount');

        // Calculate the remaining amount
        $remaining = (int) $customer->supplier_contract - $totalPaid;

        return view('payments.receipt', compact('customer', 'latestPayment', 'totalPaid', 'remaining'));
    }

    
    
    public function getPayableAmount($customer_id)
    {
        // Fetch the total amount paid by the customer
        $totalPaid = Payment::where('customer_id', $customer_id)->sum('amount');
    
        // Fetch the customer details
        $customer = Customer::find($customer_id);
    
        // Check if the customer exists
        if (!$customer) {
            return response()->json([
                'error' => 'Customer not found',
            ], 404);
        }
    
        // Fetch the supplier contract amount
        $supplierContract = $customer->supplier_contract;
    
        // Calculate the due amount
        $dueAmount = $supplierContract - $totalPaid;
    
        // Format the due amount to 2 decimal places
        $formattedDueAmount = number_format($dueAmount, 2);
    
        // Return the due amount as a JSON response
        return response()->json([
            'due_amount' => $formattedDueAmount,
        ]);
    }



}
