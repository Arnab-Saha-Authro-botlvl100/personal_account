<?php
namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        $customers = Customer::where('user', Auth::id())->get();
        return view('tickets.index', compact('tickets', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'customer_id' => 'required|exists:customers,id',
    //         'flight_date' => 'required|date',
    //         'airline' => 'required|string',
    //         'pnr_no' => 'required|string',
    //         'ticket_no' => 'required|string',
    //         'flight_no' => 'required|string',
    //         'sector' => 'required|string',
    //         'class' => 'required|string',
    //         'departure_time' => 'required|date_format:H:i',
    //         'arrival_time' => 'required|date_format:H:i',
    //         'baggage' => 'nullable|boolean',
    //         'food' => 'nullable|in:yes,no',
    //         'user' => 'required|exists:users,id',
    //     ]);

    //     Ticket::create($request->all());

    //     return redirect()->route('tickets.index')
    //         ->with('success', 'Ticket created successfully.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'flight_date' => 'required|date',
            'airline' => 'required|string',
            'pnr_no' => 'required|string',
            'ticket_no' => 'required|string',
            'flight_no' => 'required|string',
            'sector' => 'required|string',
            'class' => 'required|string',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'baggage' => 'nullable|boolean',
            'food' => 'nullable|in:yes,no',
        ]);
    
        // Merge the authenticated user's ID into the request data
        $request->merge(['user' => Auth::id()]);
    
        // Create the ticket
        Ticket::create($request->all());
    
        return redirect()->route('tickets.index')
            ->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $user_name = Auth::user()->name;
        // dd($user_name);
        return view('tickets.show', compact('ticket', 'user_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'flight_date' => 'required|date',
                'airline' => 'required|string',
                'pnr_no' => 'required|string',
                'ticket_no' => 'required|string',
                'flight_no' => 'required|string',
                'sector' => 'required|string',
                'class' => 'required|string',
                'departure_time' => 'required|date_format:H:i',
                'arrival_time' => 'required|date_format:H:i',
                'baggage' => 'nullable|boolean',
                'food' => 'nullable|in:yes,no',
            ]);

            // Format departure_time and arrival_time as full timestamps
            $validatedData['departure_time'] = $validatedData['flight_date'] . ' ' . $validatedData['departure_time'] . ':00';
            $validatedData['arrival_time'] = $validatedData['flight_date'] . ' ' . $validatedData['arrival_time'] . ':00';

            // Ensure baggage is correctly stored as boolean
            $validatedData['baggage'] = $request->has('baggage') ? 1 : 0;

            // Merge authenticated user
            $validatedData['user'] = Auth::id();

            // Update the ticket
            $ticket->update($validatedData);

            return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully');
    }
}