<x-app-layout>
    <style>
        @media (min-width: 769px) {
            #main-content {
                margin-left: 150px;
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
        .message {
            width: auto;
        }

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





    @include('layouts.links')

    <div class="container-fluid" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" style="width: 100%;">
            <div class="container-fluid mt-5 bg-light p-4 rounded shadow">
                <div class="card shadow-lg" style="width: 80%; margin: auto;">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">Transaction Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered text-center align-middle"
                                id="transaction-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" style="width: 10%;">Transaction <br> Type</th>
                                        <th scope="col" style="width: 20%;">Bank Name</th>
                                        <th scope="col" style="width: 20%;">A/C Number</th>
                                        <th scope="col" style="width: 20%;">Branch Name</th>
                                        <th scope="col" style="width: 10%;">Opening<br>Balance</th>
                                        <th scope="col" style="width: 20%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td class="fw-bold">{{ $transaction->transaction_type }}</td>
                                            <td>{{ $transaction->bank_name }}</td>
                                            <td>{{ $transaction->account_number }}</td>
                                            <td>{{ $transaction->branch_name }}</td>
                                            <td>{{ $transaction->opening_balance }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal-{{ $transaction->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <!-- Delete Button -->
                                                <form action="{{ route('transactions.destroy', $transaction->id) }}"
                                                    method="POST" class="d-inline"
                                                    id="delete-form-{{ $transaction->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger transactions-delete-btn"
                                                        data-id="{{ $transaction->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal-{{ $transaction->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel-{{ $transaction->id }}" aria-hidden="true">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header bg-info text-white">
                                                        <h5 class="modal-title"
                                                            id="editModalLabel-{{ $transaction->id }}">Edit Transaction
                                                        </h5>
                                                        <button type="button" class="btn-close text-white"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('transactions.update', $transaction->id) }}"
                                                            method="POST" id="transaction_edit_form">
                                                            @csrf
                                                            @method('PUT')

                                                            <!-- Transaction Type Dropdown -->
                                                            <div class="mb-3">
                                                                <label for="transaction_type"
                                                                    class="form-label">Transaction Type</label>
                                                                <!-- Hidden field to submit the transaction type -->
                                                                <input type="hidden" name="transaction_type"
                                                                    value="{{ $transaction->transaction_type }}">

                                                                <!-- Disabled select dropdown -->
                                                                <select name="transaction_type"
                                                                    id="transaction_type_edit" class="form-control"
                                                                    required disabled>
                                                                    <option value="cash"
                                                                        {{ $transaction->transaction_type == 'cash' ? 'selected' : '' }}>
                                                                        Cash</option>
                                                                    <option value="bank"
                                                                        {{ $transaction->transaction_type == 'bank' ? 'selected' : '' }}>
                                                                        Bank</option>
                                                                </select>
                                                            </div>

                                                            <!-- Bank Details Section -->
                                                            <div id="bankFields-edit">
                                                                <div class="mb-3">
                                                                    <label for="bank_name" class="form-label">Bank
                                                                        Name</label>
                                                                    <input type="text" class="form-control"
                                                                        name="bank_name"
                                                                        value="{{ $transaction->bank_name }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="account_number" class="form-label">A/C
                                                                        Number</label>
                                                                    <input type="text" class="form-control"
                                                                        name="account_number"
                                                                        value="{{ $transaction->account_number }}"
                                                                        maxlength="12">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="branch_name" class="form-label">Branch
                                                                        Name</label>
                                                                    <input type="text" class="form-control"
                                                                        name="branch_name"
                                                                        value="{{ $transaction->branch_name }}">
                                                                </div>

                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="opening_balance"
                                                                    class="form-label">Opening Balance</label>
                                                                <input type="number" class="form-control"
                                                                    name="opening_balance"
                                                                    value="{{ $transaction->opening_balance }}">
                                                            </div>
                                                            <!-- Submit Button -->
                                                            <div class="d-flex justify-content-end">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">

    <!-- jQuery (Required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            $('#transaction-table').DataTable({
                paging: true, // Enable pagination
                searching: true, // Enable search
                ordering: false, // Disable column sorting
                info: true // Display table information
            });


            $(document).on('click', '.transactions-delete-btn', function() {
                var transactionId = $(this).data('id'); // Get the transaction ID
                var form = $('#delete-form-' +
                    transactionId); // Get the form associated with the transaction

                // SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form after confirmation
                        form
                            .submit(); // This will trigger the form's POST request to delete the transaction
                    }
                });
            });


            // When the modal is shown, initialize form state based on the selected value
            $(document).on('show.bs.modal', '[id^=editModal]', function() {
                let modal = $(this);
                let transactionTypeSelect = modal.find("#transaction_type_edit");
                let bankFields = modal.find("#bankFields-edit");

                // Get the currently selected transaction type
                let selectedType = transactionTypeSelect.val();
                console.log("Modal opened. Current Transaction Type:", selectedType);

                // Show or hide bank fields based on selection
                if (selectedType === 'bank') {
                    bankFields.show();
                } else {
                    bankFields.hide();
                }
            });

            // Handle transaction type change inside the modal
            $(document).on('change', '#transaction_type_edit', function() {
                let modal = $(this).closest(".modal");
                let bankFields = modal.find("#bankFields-edit");

                let selectedType = $(this).val();
                console.log("Transaction type changed to:", selectedType);

                // Reset only the input fields inside the modal
                modal.find("input[type=text], input[type=number]").val("");

                // Show or hide bank fields based on selection
                if (selectedType === 'bank') {
                    bankFields.show();
                } else {
                    bankFields.hide();
                }
            });

        });
    </script>

    <script>
        // Show the message container
        const message = document.getElementById('message');
        if (message) {
            message.style.display = 'block';

            // Hide the message after 3 seconds
            setTimeout(function() {
                message.style.display = 'none';
            }, 3000);
        }
    </script>

</x-app-layout>
