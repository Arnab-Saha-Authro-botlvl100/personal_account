<x-app-layout>
    <style>
        .right-div {
            padding: 20px;
        }
    </style>
    <style>
        .left-div {
            background-color: #f8f9fa;
            /* Light background color */
            padding: 20px;
            border-right: 1px solid #dee2e6;
            /* Add a border to separate from the right div */
            height: auto;
            /* Full height */
            overflow-y: auto;
            /* Enable scrolling if content overflows */
        }

        .sum-balance {
            font-weight: 500;
            /* Medium font weight for balances */
            color: #333;
            /* Darker text color for better readability */
        }

        hr {
            border-top: 2px solid #dee2e6;
            /* Thicker horizontal line */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .left-div {
                height: auto;
                /* Adjust height for smaller screens */
                border-right: none;
                /* Remove border on smaller screens */
                border-bottom: 1px solid #dee2e6;
                /* Add bottom border for separation */
            }

            .sum-balance {
                font-size: 0.9rem;
                /* Smaller font size for balances on smaller screens */
            }

            strong {
                font-size: 1rem !important;
                /* Smaller font size for "Total Sum" on smaller screens */
            }
        }
    </style>

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
                margin-left: 30px;
                /* Match the collapsed sidebar width */
            }
        }
    </style>
    @include('layouts.links')
    <div class="container-fluid" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" style="width: 100%;">
            <div class="container-fluid" id="initial-div">
                <div class="container-fluid mt-3">
                    <div class="row">
                        <!-- Left Div (20%) -->
                        <div class="col-12 col-md-4 left-div mb-3 mb-md-0">
                            <div class="d-flex flex-column">
                                <!-- Cash and Bank Transactions Table -->
                                <div class="table-responsive">
                                    <table class="table table-primary table-striped">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Cash Transactions -->
                                            @foreach ($cashTransactions as $transaction)
                                                <tr>
                                                    <td>{{ $transaction->transaction_type }}</td>
                                                    <td class="sum-balance">{{ $transaction->balance }}</td>
                                                </tr>
                                            @endforeach
                
                                            <!-- Bank Transactions -->
                                            @foreach ($bankTransactions as $transaction)
                                                <tr>
                                                    <td>{{ $transaction->bank_name }}</td>
                                                    <td class="sum-balance">{{ $transaction->balance }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                
                                <!-- Horizontal Line -->
                                <hr class="my-3">
                
                                <!-- Total Sum -->
                                @php
                                    $totalSum = 0;
                                    foreach ($cashTransactions as $transaction) {
                                        $totalSum += (float) str_replace(',', '', $transaction->balance);
                                    }
                                    foreach ($bankTransactions as $transaction) {
                                        $totalSum += (float) str_replace(',', '', $transaction->balance);
                                    }
                                @endphp
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <strong class="fs-5 fw-bold">Total Sum</strong>
                                    <span class="sum-balance fs-5 fw-bold">{{ number_format($totalSum, 2) }}</span>
                                </div>
                            </div>
                        </div>
                
                        <!-- Right Div (80%) with Tables -->
                        <div class="col-12 col-md-8 right-div">
                            <!-- Bank Transactions Table -->
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Bank Name</th>
                                            <th>Branch</th>
                                            <th>Account Number</th>
                                            <th>Opening Balance</th>
                                            <th>Total Paid</th>
                                            <th>Total Receive</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bankTransactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->bank_name }}</td>
                                                <td>{{ $transaction->branch_name }}</td>
                                                <td>{{ $transaction->account_number }}</td>
                                                <td>{{ $transaction->opening_balance }}</td>
                                                <td>{{ $transaction->total_payment }}</td>
                                                <td>{{ $transaction->total_receive }}</td>
                                                <td>{{ $transaction->balance }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                
                            <!-- Cash Transactions Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Type</th>
                                            <th>Opening Balance</th>
                                            <th>Total Paid</th>
                                            <th>Total Receive</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cashTransactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->transaction_type }}</td>
                                                <td>{{ $transaction->opening_balance }}</td>
                                                <td>{{ $transaction->total_payment }}</td>
                                                <td>{{ $transaction->total_receive }}</td>
                                                <td>{{ $transaction->balance }}</td>
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
    </div>


</x-app-layout>
