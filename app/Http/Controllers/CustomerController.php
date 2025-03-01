<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer; // Make sure to import your Customer model
use App\Models\CustomerDetails;
use App\Models\Agent; // Make sure to import your Customer model
use App\Models\Supplier; // Make sure to import your Customer model
use App\Models\Service; // Make sure to import your Customer model
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //
    public function index()
    {
        // Your existing index method to display the customer list.
        $customers = Customer::all(); // Example: Get all customers
        return view('customers.index', compact('customers'));
    }


    public function create()
    {
        $customers = Customer::where('customers.is_delete', 0)
        ->where('customers.is_active', 1)
        ->where('customers.user', Auth::id())
        ->leftJoin('agents', 'customers.agent', '=', 'agents.id')
        ->leftJoin('suppliers', 'customers.supplier', '=', 'suppliers.id')
        ->leftJoin('services', 'customers.service', '=', 'services.id')
        ->leftJoin('contracts', 'customers.contract_id', '=', 'contracts.id')
        ->leftJoin('customer_details', 'customer_details.customer_id', '=', 'customers.id')
        ->select(
            'customers.*', // Select all columns from the customers table
            'agents.name as agent_name', // Select agent name
            'suppliers.name as supplier_name', // Select supplier name
            'services.name as service_name', // Select service name
            'contracts.invoice_no as invoice_no', // Select contract invoice number
            'customer_details.passport_issue_date',
            'customer_details.date_of_birth',
            'customer_details.medical_name',
            'customer_details.medical_issue_date',
            'customer_details.medical_status',
            'customer_details.mofa_no',
            'customer_details.mofa_date',
            'customer_details.biomatrics_date',
            'customer_details.biomatric_status',
            'customer_details.police_clearance_no',
            'customer_details.visa_no',
            'customer_details.training_info',
            'customer_details.visa_stemping_date',
            'customer_details.bmet_finger',
            'customer_details.manpower_date'
        )
        ->orderBy('created_at', 'desc')
        ->get();

        $agents = Agent::where('is_active', 1)
            ->where('user', Auth::id())
            ->where('is_delete', 0)
            ->get();

        // Fetch suppliers
        $suppliers = Supplier::where('is_active', 1)
            ->where('user', Auth::id())
            ->where('is_delete', 0)
            ->get();

        // Fetch services
        $services = Service::where('is_delete', 0)
            ->where('user', Auth::id())
            ->get();

        // Generate a unique 6-digit customer_id
        $customer_id = $this->generateUniqueCustomerId();

        // dd($customers);

        // Return the view with the form and pass the generated customer_id
        return view('customers.create', compact('customers', 'agents', 'suppliers', 'services', 'customer_id'));
    }


    // Helper function to generate a unique 6-digit customer_id
    private function generateUniqueCustomerId()
    {
        do {
            // Generate a random 6-digit number
            $customer_id = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
            
            // Check if the generated customer_id already exists in the database
            $exists = Customer::where('customer_id', $customer_id)->exists();
        } while ($exists); // Repeat until a unique customer_id is found

        return $customer_id;
    }


    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'customer_id' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'gender' => 'nullable|in:Male,Female,Other',
            'agent_contract' => 'required|numeric',
            'supplier_contract' => 'nullable|numeric',
            'passport_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'nid_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'note' => 'nullable|string',
            'passport_number' => 'required|string|max:255',
            'agent' => 'required|exists:agents,id',
            'supplier' => 'nullable|exists:suppliers,id',
            'service' => 'required|exists:services,id',
            // 'passport_expiry_date' => 'required|date',
            'country_of_residence' => 'nullable|string|max:255',
            'address_line_1' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'user' => 'nullable|exists:users,id',
            'is_delete' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Handle file uploads
        if ($request->hasFile('passport_file')) {
            $passportFilePath = $request->file('passport_file')->store('passport_files', 'public');
            $validatedData['passport_file'] = $passportFilePath;
        }

        if ($request->hasFile('nid_file')) {
            $nidFilePath = $request->file('nid_file')->store('nid_files', 'public');
            $validatedData['nid_file'] = $nidFilePath;
        }

        // Set default values for is_delete and is_active if not provided
        $validatedData['is_delete'] = $validatedData['is_delete'] ?? false;
        $validatedData['is_active'] = $validatedData['is_active'] ?? true;
        $validatedData['user'] = Auth::id();
        // Create the customer record
        $customer = Customer::create($validatedData);

       // Redirect or return a response, passing customer_id as a parameter to the route
        return redirect()->route('customers.create', ['customer_id' => $customer->customer_id])
        ->with('success', 'Customer created successfully! Customer ID: ' . $customer->customer_id);

    }


    public function show(Customer $customer) // Route model binding
    {
        $customerData = $customer->toArray(); // Convert the model to an array

        if ($customer->passport_file && Storage::disk('public')->exists($customer->passport_file)) {
            $customerData['passport_file_url'] = asset('storage/' . $customer->passport_file);
        } else {
            $customerData['passport_file_url'] = null;
        }
    
        if ($customer->nid_file && Storage::disk('public')->exists($customer->nid_file)) {
            $customerData['nid_file_url'] = asset('storage/' . $customer->nid_file);
        } else {
            $customerData['nid_file_url'] = null;
        }
        // dd($customerData);
        return response()->json(['data' => $customerData]); // Return JSON response
    }

    public function update(Request $request, $id)
    {
        // Find the customer by ID or fail
        $customer = Customer::findOrFail($id);
    
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'customer_id' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'gender' => 'nullable|in:Male,Female,Other',
            'agent_contract' => 'required|numeric',
            'supplier_contract' => 'nullable|numeric',
            'passport_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'nid_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'note' => 'nullable|string',
            'passport_number' => 'required|string|max:255',
            'agent' => 'required|exists:agents,id',
            'supplier' => 'nullable|exists:suppliers,id',
            'service' => 'required|exists:services,id',
            // 'passport_expiry_date' => 'required|date',
            'country_of_residence' => 'nullable|string|max:255',
            'address_line_1' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'user' => 'nullable|exists:users,id',
            'is_delete' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);
    
          // Handle file uploads
          if ($request->hasFile('passport_file')) {
            $passportFilePath = $request->file('passport_file')->store('passport_files', 'public');
            $validatedData['passport_file'] = $passportFilePath;
        }

        if ($request->hasFile('nid_file')) {
            $nidFilePath = $request->file('nid_file')->store('nid_files', 'public');
            $validatedData['nid_file'] = $nidFilePath;
        }

    
        // Update customer fields
        $customer->fill($validatedData);
        $customer->save();
    
        // Redirect with success message
        return redirect()->route('customers.create')->with('success', 'Customer updated successfully!');
    }

    public function destroy($id)
    {
        // Find the customer by ID
        $customer = Customer::findOrFail($id);

        try {
          
            // Delete the customer record
            $customer->is_delete = 1;
            $customer->is_active = 0;
            $customer->save();

            // Redirect with a success message
            return redirect()->route('customers.create')->with('success', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors and redirect back with an error message
            return redirect()->route('customers.create')->with('error', 'Failed to delete customer. Please try again.');
        }
    }

    public function storeCustomerDetails(Request $request, $customerId)
    {
        $request->validate([
            'passport_issue_date' => 'nullable|date',
            'date_of_birth' => 'nullable|date',
            'medical_name' => 'nullable|string|max:255',
            'medical_issue_date' => 'nullable|date',
            'medical_status' => 'nullable|string|max:255',
            'mofa_no' => 'nullable|string|max:255',
            'mofa_date' => 'nullable|date',
            'biomatrics_date' => 'nullable|date',
            'biomatric_status' => 'nullable|string|max:255',
            'police_clearance_no' => 'nullable|string|max:255',
            'visa_no' => 'nullable|string|max:255',
            'training_info' => 'nullable|string',
            'visa_stemping_date' => 'nullable|date',
            'bmet_finger' => 'nullable|date',
            'manpower_date' => 'nullable|date',
        ]);

        $customerDetails = new CustomerDetails($request->all());
        $customerDetails->customer_id = $customerId;
        $customerDetails->save();

        return redirect()->route('customers.create')->with('success', 'Customer details added successfully.');
    }

}
