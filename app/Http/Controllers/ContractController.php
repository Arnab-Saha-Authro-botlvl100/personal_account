<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\Agent;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ContractController extends Controller{
   
   public function index(){
        $contracts = Contract::where('user', Auth::id())->get();
        // dd($contracts);
        foreach ($contracts as $contract) {
            $contract->agent_name = Agent::find($contract->agent)->name ?? 'N/A'; // Default to 'N/A' if agent is not found
            $contract->supplier_name = Supplier::find($contract->supplier)->name ?? 'N/A'; // Default to 'N/A' if supplier is not found
        }
        return view('contract.index', compact('contracts'));
   }

    
   public function create($id) 
   {
       // Retrieve the customer by ID
       $customer = Customer::find($id);
   
       if (!$customer) {
           return response()->json(['error' => 'Customer not found.'], 404);
       }
   
       // Start a database transaction
       DB::beginTransaction();
   
       try {
           // Create a new contract
           $contract = new Contract();
           $contract->invoice_no = $this->generateUniqueInvoiceNo();
           $contract->date = now(); // Use the current date instead of customer creation date
           $contract->agent = $customer->agent;
           $contract->agent_price = $customer->agent_contract;
           $contract->supplier = $customer->supplier;
           $contract->supplier_price = $customer->supplier_contract;
           $contract->profit = (int)$customer->agent_contract - (int)$customer->supplier_contract;
           $contract->user = Auth::id();
           $contract->customer_id = $customer->id;
   
           // Save the contract
           if (!$contract->save()) {
               throw new \Exception('Failed to save contract.');
           }
   
           // Update the customer's contract_id with the newly created contract's ID
           $customer->contract_id = $contract->id;
           if (!$customer->save()) {
               throw new \Exception('Failed to update customer with contract ID.');
           }
   
           // Commit the transaction
           DB::commit();
   
           // Return a success response
           return response()->json(['success' => 'Contract confirmed successfully.'], 200);
   
       } catch (\Exception $e) {
           // Rollback the transaction in case of an error
           DB::rollBack();
   
           return response()->json(['error' => 'Contract creation failed: ' . $e->getMessage()], 500);
       }
   }
   

    private function generateUniqueInvoiceNo()
    {
        do {
            // Generate a random invoice number (you can customize this format)
            $invoiceNo = 'INV-' . Str::random(8); // Use Str::random() instead of str_random()
        } while (Contract::where('invoice_no', $invoiceNo)->exists()); // Check if invoice number exists in the contract table
        
        return $invoiceNo; // Return the unique invoice number
    }

    // Store the contract data

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate incoming request
        $validated = $request->validate([
            'invoice_no' => 'required|string|unique:contracts,invoice_no',
            'contract_name' => 'required|string|max:255',
            'contract_details' => 'nullable|string',
            'date' => 'required|date',
            'agent' => 'required|string',
            'agent_price' => 'required|numeric',
            'supplier' => 'required|string',
            'supplier_price' => 'required|numeric',
            'customer_id' => 'required|exists:customers,id', // Ensure the customer_id exists in the customers table
        ]);
        
    
        // Add authenticated user ID
        $validated['user'] = Auth::id();
    
        $customername = Customer::where('id', $request->customer_id)
        ->value(DB::raw("CONCAT(first_name, ' ', middle_name, ' ', last_name)"));

        // Use a database transaction
        DB::beginTransaction();
        try {
            // Attempt to create the contract
            Contract::create($validated);
    
            // Commit the transaction if successful
            DB::commit();
    
            // return redirect()->route('contract.create')->with('success', 'Contract created successfully!');
            return redirect()->route('contract.create', ['customer_id' => $validated['customer_id']])
            ->with('success', 'Contract created successfully! For '.$customername);
        
        } catch (\Exception $e) {
            // Rollback the transaction on failure
            DB::rollBack();
    
            // Log the error for debugging
            \Log::error('Error creating contract: ' . $e->getMessage());
            // Redirect back with an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    // Show the contract details
    public function show($id)
    {
        $contract = Contract::findOrFail($id);
        return view('contract.show', compact('contract')); // Pass contract data to view
    }

    // Delete the contract
    public function destroy($id)
    {
        $contract = Contract::findOrFail($id);
        $customerid = $contract->customer_id;
        $contract->delete();

        return redirect()
        ->route('contract.create', $customerid)
        ->with('success', 'Contract deleted successfully!');
    }

    public function edit($id)
    {
        $contract = Contract::findOrFail($id);
        if($contract){
            $customer = customer::findOrFail($contract->customer_id);
        }
         // Fetch agents that are active and not deleted
         $agents = Agent::where([
            ['user', '=', Auth::id()],
            ['is_delete', '=', 0],
            ['is_active', '=', 1],
        ])->get();

        // Fetch suppliers that are active and not deleted
        $suppliers = Supplier::where([
            ['user', '=', Auth::id()],
            ['is_delete', '=', 0],
            ['is_active', '=', 1],
        ])->get();
        return view('contract.edit', compact('contract','customer','agents','suppliers'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'invoice_no' => 'required|string|unique:contracts,invoice_no,' . $id, // Exclude current ID for uniqueness check
            'contract_name' => 'required|string|max:255',
            'contract_details' => 'nullable|string',
            'date' => 'required|date',
            'agent' => 'required|exists:agents,id', // Ensure the agent exists
            'agent_price' => 'required|numeric',
            'supplier' => 'required|exists:suppliers,id', // Ensure the supplier exists
            'supplier_price' => 'required|numeric',
            'customer_id' => 'required|exists:customers,id', // Ensure the customer exists
        ]);

        try {
            // Find the contract record by ID
            $contract = Contract::findOrFail($id);

            // Update the contract with the validated data
            $contract->update($validated);

            return redirect()
                ->route('contract.create', $contract->id)
                ->with('success', 'Contract updated successfully!');
        } catch (\Exception $e) {
            // Handle any errors that occur during the update process
            return redirect()
                ->route('contract.create', $id)
                ->with('error', 'Failed to update contract: ' . $e->getMessage());
        }
    }


}
