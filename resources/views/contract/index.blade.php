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

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @include('layouts.links')

    <div class="container-fluid" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" style="width: 100%;">
            <div class="container-fluid mt-5 bg-light p-4 rounded shadow">
                <h2 class="text-center text-primary mb-4" style="    background-color: antiquewhite;
    border-radius: 10px;
    padding: 10px;">Contracts List</h2>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="bg-primary text-white">
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
                                    <td>{{ $contract->invoice_no }}</td>
                                    <td>{{ $contract->customer->name }}</td>
                                    <td>{{ Str::limit($contract->contract_details, 50) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($contract->date)->format('d-m-Y') }}</td>
                                    <td>{{ $contract->agent_name }}</td>
                                    <td>{{ number_format($contract->agent_price, 2) }}</td>
                                    <td>{{ $contract->supplier_name }}</td>
                                    <td>{{ number_format($contract->supplier_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>


</x-app-layout>
