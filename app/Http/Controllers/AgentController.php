<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
   
     // Show the agent creation form
     public function create()
     {
         return view('agents.create');
     }
 
    
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
           
        ]);

        // Add the authenticated user's ID to the validated data
        $validated['user'] = Auth::id();
        $validated['email'] = $request->email;
        $validated['address'] = $request->address;

        try {
            // Create the agent
            Agent::create($validated);
            return redirect()->route('dashboard')->with('success', 'Agent created successfully!');
        } catch (\Exception $e) {
         
            // Flash error message to session in case of failure
            return redirect()->route('dashboard')->with('error', 'Failed to create agent. Please try again.');
        }
    }

    // In AgentController.php
    public function update(Request $request)
    {
        $agent = Agent::find($request->agentId);

        if ($agent) {
            $agent->name = $request->name;
            $agent->phone = $request->phone;
            $agent->email = $request->email;
            $agent->address = $request->address;
            $agent->save();

            return response()->json(['message' => 'Agent updated successfully']);
        }

        return response()->json(['message' => 'Agent not found'], 404);
    }

    public function destroy($id)
    {
        // dd($id);
        $agent = Agent::find($id);
        if (!$agent) {
            return response()->json(['error' => 'Agent not found'], 404); // Ensure agent exists
        }

        try {
            // Soft delete the agent
            $agent->is_delete = 1;
            $agent->is_active = 0;
            $agent->save(); // Use save() to persist changes
            
            return response()->json(['message' => 'Agent marked as deleted successfully']);
        } catch (\Exception $e) {
            // Handle any error during the update process
            return response()->json(['error' => 'Service deletion failed'], 500);
        }
    }

}
