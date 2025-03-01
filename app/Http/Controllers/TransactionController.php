<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'transaction_type' => 'required|in:cash,bank',
            'amount' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:12',
            'branch_name' => 'nullable|string|max:255',
            'opening_balance' => 'nullable|numeric|min:0',
        ]);
    
        // Add the authenticated user's ID to the request data
        $request->merge(['user' => Auth::id()]);
    
        try {
            // Create the transaction
            Transaction::create($request->all());
    
            return redirect()->back()->with('success', 'Transaction added successfully.');
        } catch (\Exception $e) {
            // Log the error and return with an error message
            return redirect()->back()->with('error', 'Failed to add transaction.', $e->getMessage());
        }
    }
    public function update(Request $request, Transaction $transaction)
    {
        // Validate the request
        $request->validate([
            'transaction_type' => 'required|in:cash,bank',
            'amount' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:12',
            'branch_name' => 'nullable|string|max:255',
            'opening_balance' => 'nullable|numeric|min:0',
        ]);

        // Update the transaction
        $transaction->update($request->all());

        return redirect()->back()->with('success', 'Transaction Updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        // Soft delete the transaction by setting is_delete to 1
        $transaction->update(['is_delete' => 1]); 
    
        return redirect()->back()->with('success', 'Transaction deleted successfully.');
    }
    
}