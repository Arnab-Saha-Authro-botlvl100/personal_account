<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        Service::create([
            'name' => $request->name,
            'details' => $request->details,
            'user' => Auth::id(), // Automatically assign the authenticated user
            'is_delete' => 0,
        ]);
    
        return redirect()->back()->with('success', 'Service created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            // Find the service by ID and delete it
            $service = Service::findOrFail($id);
            $service->delete();

            return response()->json(['success' => 'Service deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service deletion failed'], 500);
        }
    }

}
