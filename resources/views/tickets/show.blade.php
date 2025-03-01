<x-app-layout>
    <div class="container">
        <h1 class="my-4">Ticket Details</h1>
    
        <div class="card">
            <div class="card-body">
                <!-- Ticket Information -->
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <p><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
                        <p><strong>Customer:</strong> {{ $ticket->customer->name }}</p> <!-- Assuming a relationship with Customer -->
                        <p><strong>Flight Date:</strong> {{ $ticket->flight_date }}</p>
                        <p><strong>Airline:</strong> {{ $ticket->airline }}</p>
                        <p><strong>PNR No:</strong> {{ $ticket->pnr_no }}</p>
                        <p><strong>Ticket No:</strong> {{ $ticket->ticket_no }}</p>
                    </div>
    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <p><strong>Flight No:</strong> {{ $ticket->flight_no }}</p>
                        <p><strong>Sector:</strong> {{ $ticket->sector }}</p>
                        <p><strong>Class:</strong> {{ $ticket->class }}</p>
                        <p><strong>Departure Time:</strong> {{ $ticket->departure_time }}</p>
                        <p><strong>Arrival Time:</strong> {{ $ticket->arrival_time }}</p>
                    </div>
                </div>
    
                <!-- Full Width Fields -->
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Baggage:</strong> {{ $ticket->baggage ? 'Yes' : 'No' }}</p>
                        <p><strong>Food:</strong> {{ ucfirst($ticket->food) }}</p>
                        <p><strong>Created By:</strong> {{ $user_name }}</p> <!-- Assuming a relationship with User -->
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Back Button -->
        <div class="mt-4">
            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Tickets
            </a>
        </div>
    </div>
</x-app-layout>