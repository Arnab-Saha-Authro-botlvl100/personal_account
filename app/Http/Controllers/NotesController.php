<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NotesController extends Controller
{
    //
    public function store(Request $request)
    {
        try {
            // Validate the incoming data
            $request->validate([
                'title' => 'required|string|max:255', // Title is required and should be a string
                'description' => 'nullable|string', // Description is optional but should be a string if provided
                'status' => 'required|in:pending,completed', // Status must be either 'pending' or 'completed'
            ]);

            // Create a new note and assign the validated data
            $note = new Note();
            $note->user = auth()->id(); // Assuming the user is logged in
            $note->title = $request->title; // Assign title from the request
            $note->date = $request->date; // Assign date
            $note->description = $request->description; // Assign description from the request
            $note->status = $request->status; // Assign status from the request
            $note->save(); // Save the note to the database

            // Redirect to the notes index with a success message
            return redirect()->route('dashboard')->with('success', 'Note added successfully!');
        } catch (\Exception $e) {
            // If an error occurs, return a custom error message
            return redirect()->route('dashboard')->with(['error' => 'An error occurred while saving the note. Please try again.']);
        }
    }

    public function updateStatus(Request $request)
    {
        $note = Note::find($request->id);
        if ($note) {
            $note->status = $request->status;
            $note->save();
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Note not found.'], 404);
    }

    public function updateDescription(Request $request)
    {
        $note = Note::find($request->id);
        if ($note) {
            $note->description = $request->description;
            $note->save();
            return response()->json(['success' => true, 'message' => 'Description updated successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Note not found.'], 404);
    }

}
