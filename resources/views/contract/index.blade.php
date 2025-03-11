<x-app-layout>
    <style>
     
        .dt-search{
            margin: 20px;
        }
        .dt-paging nav{
            margin-top: 10px!important;
            display: flex !important;
            flex-direction: row !important;
            justify-content: space-between;
        }
        label{
            display: inline;
        }
        @media (min-width: 769px) {
            #main-content {
                margin-left: 50px;
                /* Match the width of the sidebar */
                transition: 0.3s;
                /* Smooth transition for margin */
                padding: 20px;
                /* Optional: Add padding for better spacing */
            }

            /* When sidebar is collapsed */
            .collapsed #main-content {
                /* margin-left: 80px; */
                /* Match the collapsed sidebar width */
            }
           
        }
    </style>
    <!-- Custom Styles -->
    <style>
        /* Custom Table Styling */
        .table {
            font-size: 0.95rem;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd !important;
        }

        .table-hover tbody tr:hover {
            background-color: #f9f9f9;
        }

        /* Header Styles */
        h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #2b3d47;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Table Styling */
        .table th,
        .table td {
            padding: 12px;
            text-align: left;
        }

        /* Button Styling */
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.85rem;
        }

        /* Hover effects for actions */
        .btn-sm:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease;
        }

        .bg-info {
            background-color: #3b8bba !important;
        }

        .table th,
        .table td {
            background-color: #f9f9f9;
        }
    </style>

    <style>
        @media (max-width: 767.98px) {
            /* Make the table a block layout for mobile */
            .table-responsive table,
            .table-responsive thead,
            .table-responsive tbody,
            .table-responsive th,
            .table-responsive td,
            .table-responsive tr {
                display: block;
            }

            /* Hide the table header on mobile */
            .table-responsive thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            /* Style each row as a block */
            .table-responsive tr {
                border: 1px solid #ccc;
                margin-bottom: 10px;
            }

            /* Style each cell as a block with left-aligned label and right-aligned data */
            .table-responsive td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%; /* Space for the label */
                text-align: right; /* Align data to the right */
                font-size: 14px; /* Adjust font size for mobile */
            }

            /* Style the data-label (left side) */
            .table-responsive td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%; /* Width of the label */
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-label);
                font-weight: bold;
                text-align: left; /* Align label to the left */
                font-size: 14px; /* Adjust font size for mobile */
            }
            .dt-paging nav{
                margin-top: 10px!important;
                display: flex !important;
                flex-direction: row !important;
                justify-content: space-evenly;
            }
        }
    </style>

    @include('layouts.links')

    <div class="container-fluid" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" >
            <div class="container mt-5">
                <div class="card shadow-lg rounded-3">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Contract List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="contract-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Customer Name</th>
                                        <th>Contract Details</th>
                                        <th>Date</th>
                                        <th>Agent</th>
                                        <th>Agent Price</th>
                                        <th>Supplier</th>
                                        <th>Supplier Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contracts as $contract)
                                        <tr>
                                            <td data-label="Invoice No">{{ $contract->invoice_no }}</td>
                                            <td data-label="Customer Name">{{ $contract->customer->name }}</td>
                                            <td data-label="Contract Details">{{ Str::limit($contract->contract_details, 50) }}</td>
                                            <td data-label="Date">{{ \Carbon\Carbon::parse($contract->date)->format('d-m-Y') }}</td>
                                            <td data-label="Agent">{{ $contract->agent_name }}</td>
                                            <td data-label="Agent Price">৳ {{ number_format($contract->agent_price, 2) }}</td>
                                            <td data-label="Supplier">{{ $contract->supplier_name }}</td>
                                            <td data-label="Supplier Price">৳ {{ number_format($contract->supplier_price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
     
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
        <div id="liveToast" class="toast align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>


<!-- jQuery (Required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#contract-table').DataTable({
            // Optional configurations
            paging: true, // Enable pagination
            searching: true, // Enable search
            ordering: false, // Enable column sorting
            info: true // Display table information
        });
    });
</script>

</x-app-layout>
