<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    //
    
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
           
        ]);

        // Add the authenticated user's ID to the validated data
        $validated['user'] = Auth::id();
        $validated['email'] = $request->email;
        $validated['address'] = $request->address;


        // dd($validated);
        try {
            // Create the supplier object
            Supplier::create($validated);
            return redirect()->route('dashboard')->with('success', 'Supplier created successfully!');
        } catch (\Exception $e) {
         
            // Flash error message to session in case of failure
            return redirect()->route('dashboard')->with('error', 'Failed to create supplier. Please try again.');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);

        $supplier = Supplier::find($request->id);
        if ($supplier) {
            $supplier->name = $request->name;
            $supplier->phone = $request->phone;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->save();

            return response()->json(['message' => 'Supplier updated successfully']);
        }

        return response()->json(['error' => 'Supplier not found'], 404);
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if ($supplier) {
            try {
                // Soft delete the supplier (mark as deleted and inactive)
                $supplier->is_delete = 1;
                $supplier->is_active = 0;
                $supplier->save(); // Save the changes
                
                return response()->json(['message' => 'Supplier marked as deleted successfully']);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error deleting supplier'], 500);
            }
        }

        return response()->json(['error' => 'Supplier not found'], 404);
    }


}
