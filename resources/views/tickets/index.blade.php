<x-app-layout>
    <style>
        @media (min-width: 769px) {
            #main-content {
                margin-left: 250px;
                /* Match the width of the sidebar */
                transition: 0.3s;
                /* Smooth transition for margin */
                padding: 20px;
                /* Optional: Add padding for better spacing */
            }

            /* When sidebar is collapsed */
            .collapsed #main-content {
                margin-left: 80px;
                /* Match the collapsed sidebar width */
            }
        }

        /* Custom Styling for Heading and Button */
        h1 {
            font-size: 3rem;
            /* Larger font size */
            font-weight: bold;
            /* Bold heading */
            color: #3c6e71;
            /* Attractive primary color */
            text-transform: uppercase;
            /* Make text uppercase */
            letter-spacing: 1px;
            /* Add letter spacing for effect */
            margin-bottom: 20px;
        }

        /* Button Styles */
        .btn-gradient {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            /* Gradient effect */
            border-radius: 30px;
            /* Rounded corners */
            padding: 10px 30px;
            /* Larger padding */
            transition: transform 0.2s, background 0.3s ease;
            /* Add smooth hover effects */
            font-size: 1rem;
        }

        .btn-gradient:hover {
            transform: scale(1.05);
            /* Slightly increase size on hover */
            background: linear-gradient(to right, #feb47b, #ff7e5f);
            /* Reverse gradient on hover */
        }

        .btn-gradient i {
            font-size: 1.5rem;
            /* Larger icon size */
        }

        /* Table Styles */
        .table th,
        .table td {
            padding: 12px;
            /* More space around table cells */
        }

        .table thead {
            background-color: #3c6e71;
            /* Add background color for header */
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
            /* Hover effect on rows */
        }

        .table-responsive {
            margin-top: 20px;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {

            /* Make heading size smaller on mobile */
            h1 {
                font-size: 2rem;
                /* Smaller font size for mobile */
                text-align: center;
                /* Center-align the heading */
            }

            /* Adjust button for mobile */
            .btn-gradient {
                padding: 8px 20px;
                /* Reduced padding for smaller screens */
                font-size: 0.9rem;
                /* Slightly smaller font size */
            }

            .btn-gradient i {
                font-size: 1.2rem;
                /* Adjust icon size for mobile */
            }

            /* Adjust table styles for mobile */
            .table th,
            .table td {
                padding: 8px;
                /* Reduced padding for table on mobile */
                font-size: 0.9rem;
                /* Slightly smaller font size */
            }

            /* Stack table headings and make it scrollable horizontally */
            .table-responsive {
                overflow-x: auto;
                /* Enable horizontal scrolling for the table */
                -webkit-overflow-scrolling: touch;
                /* Smooth scrolling for touch devices */
            }

            /* Adjust button container (for mobile layout) */
            .d-flex.justify-content-center {
                justify-content: center;
                /* Center the button in smaller screens */
                width: 100%;
            }
        }
    </style>


<style>
    /* Default card width */
    .custom-card {
        width: 95%;
        max-width: 1600px!important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Media query for viewport width >= 1806px */
    @media (min-width: 1806px) {
        .custom-card {
            max-width: 1200px;
        }
    }

    /* Reduce font size for table headers and cells */
    #ticketTable th,
    #ticketTable td {
        font-size: 0.875rem;
    }

    /* Add a hover effect to table rows */
    #ticketTable tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Style action buttons */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
</style>
    @include('layouts.links')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" style="width: 100%;" >
            <div class="container-fluid" id="initial-div">
                <!-- Heading Section with Custom Styling -->
                <h1 class="text-center text-md-start fw-bold text-primary mb-2">
                    Tickets
                </h1>

                <!-- Button to trigger modal with enhanced design -->
                <div class="d-flex justify-content-center justify-content-md-start mb-4">
                    <a href="#" class="btn btn-lg btn-gradient mb-3 shadow-lg text-white" data-bs-toggle="modal"
                        data-bs-target="#createTicketModal">
                        <i class="bi bi-plus-circle me-2"></i> Create New Ticket
                    </a>
                </div>

               <!-- Ticket List Card -->
                <div class="d-flex align-items-center min-vh-100">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded custom-card">
                        <div class="card-header bg-primary fw-bold">
                            Ticket List
                        </div>
                        <div class="card-body">
                            <!-- Table within card -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="ticketTable" style="font-size: 0.875rem;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>Flight Date</th>
                                            <th>Airline</th>
                                            <th>PNR No</th>
                                            <th>Ticket No</th>
                                            <th>Flight No</th>
                                            <th>Sector</th>
                                            <th>Class</th>
                                            <th>Departure</th>
                                            <th>Arrival</th>
                                            <th>Baggage</th>
                                            <th>Food</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $index => $ticket)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $ticket->customer->name }}</td>
                                                <td>{{ $ticket->flight_date }}</td>
                                                <td>{{ $ticket->airline }}</td>
                                                <td>{{ $ticket->pnr_no }}</td>
                                                <td>{{ $ticket->ticket_no }}</td>
                                                <td>{{ $ticket->flight_no }}</td>
                                                <td>{{ $ticket->sector }}</td>
                                                <td>{{ $ticket->class }}</td>
                                                <td>{{ $ticket->departure_time }}</td>
                                                <td>{{ $ticket->arrival_time }}</td>
                                                <td>{{ $ticket->baggage ? 'Yes' : 'No' }}</td>
                                                <td>{{ $ticket->food }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" class="btn btn-warning btn-sm edit-ticket"
                                                            data-id="{{ $ticket->id }}"
                                                            data-customer_id="{{ $ticket->customer->name }}"
                                                            data-flight_date="{{ $ticket->flight_date }}"
                                                            data-airline="{{ $ticket->airline }}"
                                                            data-pnr_no="{{ $ticket->pnr_no }}"
                                                            data-ticket_no="{{ $ticket->ticket_no }}"
                                                            data-flight_no="{{ $ticket->flight_no }}"
                                                            data-sector="{{ $ticket->sector }}"
                                                            data-class="{{ $ticket->class }}"
                                                            data-departure_time="{{ $ticket->departure_time }}"
                                                            data-arrival_time="{{ $ticket->arrival_time }}"
                                                            data-baggage="{{ $ticket->baggage }}"
                                                            data-food="{{ $ticket->food }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this ticket?')">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Ticket List Card -->
            </div>
        </div>
    </div>




    <!-- Edit Ticket Modal -->
    <div class="modal fade" id="editTicketModal" tabindex="-1" aria-labelledby="editTicketModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editTicketModalLabel">Edit Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Edit Form -->
                    <form id="editTicketForm" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="edit_ticket_id" name="ticket_id">

                        <div class="row">
                            <!-- Customer ID (Readonly) -->
                            <div class="col-md-6">
                                <label for="edit_customer_id">Customer Name</label>
                                <input type="text" id="edit_customer_id" name="customer_id" class="form-control"
                                    value="{{ old('customer_id') }}" readonly>
                            </div>

                            <!-- Flight Date -->
                            <div class="col-md-6">
                                <label for="edit_flight_date">Flight Date</label>
                                <input type="date" id="edit_flight_date" name="flight_date" class="form-control"
                                    value="{{ old('flight_date') }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <!-- Airline -->
                            <div class="col-md-6">
                                <label for="edit_airline">Airline</label>
                                <input type="text" id="edit_airline" name="airline" class="form-control"
                                    value="{{ old('airline') }}">
                            </div>

                            <!-- PNR No -->
                            <div class="col-md-6">
                                <label for="edit_pnr_no">PNR No</label>
                                <input type="text" id="edit_pnr_no" name="pnr_no" class="form-control"
                                    value="{{ old('pnr_no') }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <!-- Ticket No -->
                            <div class="col-md-6">
                                <label for="edit_ticket_no">Ticket No</label>
                                <input type="text" id="edit_ticket_no" name="ticket_no" class="form-control"
                                    value="{{ old('ticket_no') }}">
                            </div>

                            <!-- Flight No -->
                            <div class="col-md-6">
                                <label for="edit_flight_no">Flight No</label>
                                <input type="text" id="edit_flight_no" name="flight_no" class="form-control"
                                    value="{{ old('flight_no') }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <!-- Sector -->
                            <div class="col-md-6">
                                <label for="edit_sector">Sector</label>
                                <input type="text" id="edit_sector" name="sector" class="form-control"
                                    value="{{ old('sector') }}">
                            </div>

                            <!-- Class -->
                            <div class="col-md-6">
                                <label for="edit_class">Class</label>
                                <input type="text" id="edit_class" name="class" class="form-control"
                                    value="{{ old('class') }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <!-- Departure Time -->
                            <div class="col-md-6">
                                <label for="edit_departure_time">Departure Time</label>
                                <input type="time" id="edit_departure_time" name="departure_time"
                                    class="form-control" value="{{ old('departure_time') }}">
                            </div>

                            <!-- Arrival Time -->
                            <div class="col-md-6">
                                <label for="edit_arrival_time">Arrival Time</label>
                                <input type="time" id="edit_arrival_time" name="arrival_time"
                                    class="form-control" value="{{ old('arrival_time') }}">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <!-- Baggage -->
                            <div class="col-md-6">
                                <label for="edit_baggage">Baggage</label>
                                <select id="edit_baggage" name="baggage" class="form-control">
                                    <option value="1" {{ old('baggage') == 1 ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0" {{ old('baggage') == 0 ? 'selected' : '' }}>No
                                    </option>
                                </select>
                            </div>

                            <!-- Food -->
                            <div class="col-md-6">
                                <label for="edit_food">Food</label>
                                <select id="edit_food" name="food" class="form-control">
                                    <option value="yes" {{ old('food') == 'yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>
                                    <option value="no" {{ old('food') == 'no' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="createTicketModal" tabindex="-1" aria-labelledby="createTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Card Header with Close Button -->
                <div class="modal-header card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="modal-title mb-0" id="createTicketModalLabel">Create New Ticket</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form inside the modal -->
                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Customer ID Dropdown -->
                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select name="customer_id" class="form-control" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Flight Date -->
                                <div class="form-group">
                                    <label for="flight_date">Flight Date</label>
                                    <input type="date" name="flight_date" class="form-control" required>
                                </div>

                                <!-- Airline -->
                                <div class="form-group">
                                    <label for="airline">Airline</label>
                                    <input type="text" name="airline" class="form-control" required>
                                </div>

                                <!-- PNR No -->
                                <div class="form-group">
                                    <label for="pnr_no">PNR No</label>
                                    <input type="text" name="pnr_no" class="form-control" required>
                                </div>

                                <!-- Ticket No -->
                                <div class="form-group">
                                    <label for="ticket_no">Ticket No</label>
                                    <input type="text" name="ticket_no" class="form-control" required>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Flight No -->
                                <div class="form-group">
                                    <label for="flight_no">Flight No</label>
                                    <input type="text" name="flight_no" class="form-control" required>
                                </div>

                                <!-- Sector -->
                                <div class="form-group">
                                    <label for="sector">Sector</label>
                                    <input type="text" name="sector" class="form-control" required>
                                </div>

                                <!-- Class -->
                                <div class="form-group">
                                    <label for="class">Class</label>
                                    <input type="text" name="class" class="form-control" required>
                                </div>

                                <!-- Departure Time -->
                                <div class="form-group">
                                    <label for="departure_time">Departure Time</label>
                                    <input type="time" name="departure_time" class="form-control" required>
                                </div>

                                <!-- Arrival Time -->
                                <div class="form-group">
                                    <label for="arrival_time">Arrival Time</label>
                                    <input type="time" name="arrival_time" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <!-- Full Width Fields -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Baggage -->
                                <div class="form-check">
                                    <!-- Hidden input to ensure a value is always sent -->
                                    <input type="hidden" name="baggage" value="0">
                                    <!-- Checkbox for baggage -->
                                    <input class="form-check-input" type="checkbox" name="baggage" value="1" id="flexCheckIndeterminate">
                                    <label class="form-check-label" for="flexCheckIndeterminate">Baggage</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Food -->
                                <div class="form-group">
                                    <label for="food">Food</label>
                                    <select name="food" class="form-control" required>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".edit-ticket").click(function() {
                var ticketId = $(this).data("id");

                // Populate the modal fields
                $("#edit_ticket_id").val(ticketId);
                $("#edit_customer_id").val($(this).data("customer_id"));

                // Extract only YYYY-MM-DD from flight_date
                var flightDate = $(this).data("flight_date");
                $("#edit_flight_date").val(flightDate ? flightDate.substring(0, 10) : "");

                $("#edit_airline").val($(this).data("airline"));
                $("#edit_pnr_no").val($(this).data("pnr_no"));
                $("#edit_ticket_no").val($(this).data("ticket_no"));
                $("#edit_flight_no").val($(this).data("flight_no"));
                $("#edit_sector").val($(this).data("sector"));
                $("#edit_class").val($(this).data("class"));

                // Extract only HH:MM from timestamp for time fields
                var departureTime = $(this).data("departure_time");
                var arrivalTime = $(this).data("arrival_time");

                $("#edit_departure_time").val(departureTime ? departureTime.substring(11, 16) : "");
                $("#edit_arrival_time").val(arrivalTime ? arrivalTime.substring(11, 16) : "");

                // Populate baggage and food fields
                var baggage = $(this).data("baggage");
                $("#edit_baggage").val(baggage == 1 ? "1" : "0");

                $("#edit_food").val($(this).data("food"));

                // Set form action dynamically
                $("#editTicketForm").attr("action", "/tickets/" + ticketId);

                // Show the modal
                $("#editTicketModal").modal("show");
            });

        });
    </script>
</x-app-layout>
