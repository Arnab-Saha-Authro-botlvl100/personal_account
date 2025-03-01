<?php

namespace App\Http\Controllers;


use App\Models\PreviousDue;
use Illuminate\Http\Request;

class PreviousDueController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:agent,supplier',
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string',
            'agent_id' => 'required_if:type,agent|nullable|exists:agents,id',
            'supplier_id' => 'required_if:type,supplier|nullable|exists:suppliers,id',
        ]);

        PreviousDue::create([
            'type' => $request->type,
            'agent_id' => $request->type === 'agent' ? $request->agent_id : null,
            'supplier_id' => $request->type === 'supplier' ? $request->supplier_id : null,
            'amount' => $request->amount,
            'note' => $request->note,
            'user' => auth()->id(),
        ]);

        return response()->json(['message' => 'Previous due added successfully']);
    }

    public function index()
    {
        $previousDues = PreviousDue::with(['agent', 'supplier'])->get();
        return response()->json($previousDues);
    }

    public function destroy($id)
    {
        $previousDue = PreviousDue::find($id);

        if (!$previousDue) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        $previousDue->delete();

        return response()->json(['message' => 'Previous due deleted successfully']);
    }
}
