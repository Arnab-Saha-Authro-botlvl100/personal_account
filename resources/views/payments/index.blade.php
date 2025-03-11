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
                margin-left: 30px;
                /* Match the collapsed sidebar width */
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @include('layouts.links')

    @if(session('clipboard_text'))
        <!-- Hidden Textarea for Copying -->
        <textarea id="clipboardText" style="position: absolute; left: -9999px;">{{ session('clipboard_text') }}</textarea>

        <!-- Bootstrap Toast -->
        <div class="toast-container position-fixed" style="right: 0; bottom: 0; z-index: 1050; padding: 1rem;">
            <div id="copyToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="polite" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body" style="background-color: #28a79a; color: white; padding: 10px 20px; border-radius: 5px;">
                        Payment information copied to clipboard!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif


    <div class="container-fluid" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" style="width: 100%;">
            <div class="container-fluid" id="initial-div">
                <!-- Receive Form -->
                <div class="container mt-4">
                    
                    <div class="card">
                        <div class="card-header bg-dark text-white text-center">
                            <h5 class="mb-0">Payment Transaction</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('payments.store') }}" method="POST" id="payment_form" class="p-4 bg-white shadow rounded">
                                @csrf
                            
                                <!-- Date and Receive Type -->
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date" required>
                                    </div>
                            
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="receive_type" class="form-label">Receive Type</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-list"></i></span>
                                            <select name="receive_type" id="receive_type" class="form-select width-style" required>
                                                <option value="">Select</option>
                                                <option value="customer">Customer</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Customer Selection and Name -->
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 mb-3" id="customer_selection" style="display: none;">
                                        <label for="customer_id" class="form-label">Select Customer</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            <select name="customer_id" id="customer_id" class="form-select width-style">
                                                <option value="">Select a customer</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" 
                                                        data-contract-invoice="{{ $customer->supplier_name }}" 
                                                        data-agent-contract="{{ $customer->supplier_contract }}" 
                                                        >
                                                        {{ $customer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                            
                                    <div class="col-12 col-md-6 mb-3 customer-info" style="display: none;">
                                        <label for="customer_name" class="form-label">Customer Name</label>
                                        <input type="text" class="form-control" name="customer_name" id="customer_name" readonly>
                                    </div>
                                </div>
                            
                                <!-- Supplier, Supplier Contract, and Due Amount -->
                                <div class="row mb-3 customer-info" id="customer-info" style="display: none;">
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="contract_invoice" class="form-label">Supplier</label>
                                        <input type="text" class="form-control" name="contract_invoice" id="contract_invoice" readonly>
                                    </div>
                            
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="supplier_contract" class="form-label">Supplier Contract</label>
                                        <input type="text" class="form-control" name="payment_amount" id="supplier_contract" readonly>
                                    </div>
                            
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="due_amount" class="form-label">Due Amount</label>
                                        <input type="text" class="form-control" name="due_amount" id="due_amount" readonly>
                                    </div>
                                </div>
                            
                                <!-- Transaction Method and Bank Details -->
                                <div class="row mb-3">
                                    <!-- Transaction Method -->
                                    <div class="col-12 col-md-2 mb-3">
                                        <label for="transaction_method" class="form-label">Transaction Method</label>
                                        <div class="input-group">
                                            <select name="transaction_method" id="transaction_method" class="form-select w-100" required>
                                                <option value="cash">Cash</option>
                                                <option value="bank">Bank</option>
                                            </select>
                                        </div>
                                    </div>
                            
                                    <!-- Bank Details -->
                                    {{-- <div class="col-12 col-md-10 mb-3" id="bank_details" style="display: none;">
                                        <div class="row">
                                            <!-- Bank Name -->
                                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                <label for="bank_name" class="form-label">Bank Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-university"></i></span>
                                                    <select name="bank_name" id="bank_name" class="form-select" style="width: 80%">
                                                        <option value="">Select a bank</option>
                                                        @foreach ($banks as $bank)
                                                            <option value="{{ $bank->id }}" 
                                                                data-account-number="{{ $bank->account_number }}" 
                                                                data-branch-name="{{ $bank->branch_name }}">
                                                                {{ $bank->bank_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                            
                                            <!-- Account Number -->
                                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                <label for="account_number" class="form-label">Account Number</label>
                                                <input type="text" class="form-control" name="account_number" id="account_number" readonly>
                                            </div>
                            
                                            <!-- Branch Name -->
                                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                <label for="branch_name" class="form-label">Branch Name</label>
                                                <input type="text" class="form-control" name="branch_name" id="branch_name" readonly>
                                            </div>
                                        </div>
                                    </div> --}}
                                     <!-- Bank Details -->
                                     <div class="col-12 col-md-10 mb-3" id="bank_details" style="display: none;">
                                        <div class="row">
                                            <!-- Bank Name -->
                                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                <label for="bank_name" class="form-label">Bank Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fa fa-university"></i></span>
                                                    <select name="bank_name" id="bank_name" class="form-select" style="width: 80%">
                                                        <option value="">Select a bank</option>
                                                        @foreach ($banks as $bank)
                                                            <option value="{{ $bank->id }}" 
                                                                data-account-number="{{ $bank->account_number }}" 
                                                                data-branch-name="{{ $bank->branch_name }}">
                                                                {{ $bank->bank_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                            
                                            <!-- Account Number -->
                                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                <label for="account_number_display" class="form-label">Account Number</label>
                                                <span id="account_number_display" class="form-control"></span>
                                                <input type="hidden" name="account_number" id="account_number">
                                            </div>

                                            <!-- Branch Name -->
                                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                <label for="branch_name_display" class="form-label">Branch Name</label>
                                                <span id="branch_name_display" class="form-control"></span>
                                                <input type="hidden" name="branch_name" id="branch_name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <!-- Amount and Note -->
                                <div class="row mb-3">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="number" class="form-control" name="amount" required>
                                    </div>
                            
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="note" class="form-label">Note</label>
                                        <textarea class="form-control" name="note" rows="3"></textarea>
                                    </div>
                                </div>
                            
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary w-100">Payment</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="container mt-4">
                    <div class="card shadow-lg">
                        <div class="card-header bg-dark text-white text-center">
                            <h4 class="mb-0">Payment Transactions</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered text-center" id="receive-table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Receive Type</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Supplier</th>
                                            <th scope="col">Supplier Contract</th>
                                            <th scope="col">Transaction Method</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Note</th>
                                            {{-- <th scope="col">Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $receive)
                                            <tr>
                                                <td>{{ $receive->date }}</td>
                                                <td>{{ ucfirst($receive->receive_type) }}</td>
                                                <td>{{ $receive->customer_name }}</td>
                                                <td>{{ $receive->contract_invoice }}</td>
                                                <td>{{ $receive->payment_amount }}</td>
                                                <td>{{ ucfirst($receive->transaction_method) }}</td>
                                                <td class="fw-bold text-success">{{ number_format($receive->amount, 2) }}</td>
                                                <td>{{ $receive->note }}</td>
                                                {{-- <td>
                                                    <a href="{{ route('receives.edit', $receive->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                    <form action="{{ route('receives.destroy', $receive->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </form>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-muted text-center">
                            <small>Showing {{ count($payments) }} transactions</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="message" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">

                <!-- Logged in Message -->
        @if(session('logged_in'))
        <div style="background-color: #50e233;" class="shadow-lg rounded p-4 text-white mb-2">
            <b>{{ session('logged_in') }}</b>
        </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
        <div style="background-color: #50e233;" class="shadow-lg rounded p-4 text-white">
            <b>{{ session('success') }}</b>
        </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
        <div style="background-color: #f44336;" class="shadow-lg rounded p-4 text-white">
            <b>{{ session('error') }}</b>
        </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
        <div style="background-color: #f44336;" class="shadow-lg rounded p-4 text-white">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>


    
 <!-- DataTables CSS -->
 <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">

 <!-- jQuery (Required for DataTables) -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- DataTables JS -->
 <script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>

 {{-- sweetalert --}}
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- jQuery for dynamic behavior -->
<script>
    // Show the message container
    const message = document.getElementById('message');
    if (message) {
        message.style.display = 'block';

        // Hide the message after 3 seconds
        setTimeout(function () {
            message.style.display = 'none';
        }, 3000);
    }
</script>

<script>
    $(document).ready(function () {

        $('#receive-table').DataTable({
                // Optional configurations
                paging: true,          // Enable pagination
                searching: true,       // Enable search
                ordering: false,        // Enable column sorting
                info: true             // Display table information
        });

         // Show/hide customer selection and details based on receive type
        $('#receive_type').change(function () {
            if ($(this).val() === 'customer') {
                $('#customer_selection').show();
                $('.customer-info').show();
            } else {
                $('#customer_selection').hide();
                $('.customer-info').hide();
                $('#customer_name').val('');
                $('#contract_invoice').val('');
                $('#supplier_contract').val('');
                $('#due_amount').val('');
            }
        });

        // Populate customer details when a customer is selected
        $('#customer_id').change(function () {
            const selectedCustomer = $(this).find(':selected');
            const customerId = selectedCustomer.val();

            // Populate customer name, contract invoice, and supplier contract
            $('#customer_name').val(selectedCustomer.text());
            $('#contract_invoice').val(selectedCustomer.data('contract-invoice'));
            $('#supplier_contract').val(selectedCustomer.data('agent-contract'));

            // Fetch payable amount via AJAX
            if (customerId) {
                $.ajax({
                    url: `/get-payable-amount/${customerId}`,
                    method: 'GET',
                    success: function (response) {
                        // Update the due amount field with the fetched value
                        $('#due_amount').val(response.due_amount);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching payable amount:', error);
                        $('#due_amount').val(''); // Clear the due amount field on error
                    }
                });
            } else {
                $('#due_amount').val(''); // Clear the due amount field if no customer is selected
            }
        });

        // Show/hide bank details based on transaction method
        $('#transaction_method').change(function () {
            if ($(this).val() === 'bank') {
                $('#bank_details').show();
            } else {
                $('#bank_details').hide();
                $('#bank_name').val('');
                $('#account_number').val('');
                $('#branch_name').val('');
            }
        });

    // Populate bank details when a bank is selected
        $(document).on('change', '#bank_name', function () {
            const selectedBank = $(this).find(':selected');
            
            const accountNumber = selectedBank.data('account-number') || '';
            const branchName = selectedBank.data('branch-name') || '';

            // Update displayed values
            $('#account_number_display').text(accountNumber);
            $('#branch_name_display').text(branchName);

            // Update hidden input values to be passed in form submission
            $('#account_number').val(accountNumber);
            $('#branch_name').val(branchName);
                

        });

        $('#payment_form').on('submit', function (event) {
            event.preventDefault();

            let formData = new FormData(this);

            formData.set('account_number', $('#account_number_display').text());
            formData.set('branch_name', $('#branch_name_display').text());

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status === 'success') {
                        const clipboardText = JSON.parse(response.clipboard_text); 
                        let clipboardString = '';

                        for (const key in clipboardText) {
                            clipboardString += `${key}: ${clipboardText[key]}\n`;
                        }

                        const tempTextArea = document.createElement("textarea");
                        tempTextArea.value = clipboardString;  // The string to be copied
                        document.body.appendChild(tempTextArea);
                        tempTextArea.select();
                        document.execCommand('copy');
                        document.body.removeChild(tempTextArea);
                        // Show success toast
                        Swal.fire({
                            title: "Payment Successful",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = response.redirect_url;
                            }
                        });

                        // Show additional toast for clipboard success
                        var clipboardToast = new bootstrap.Toast(document.getElementById('copyToast'));
                        clipboardToast.show();
                    }
                },
                error: function (error) {
                    console.log("Error:", error);
                    let errorMessage = "Something went wrong. Please try again.";
                    if (error.responseJSON) {
                        if (error.responseJSON.errors) {
                            errorMessage = Object.values(error.responseJSON.errors).flat().join("\n");
                        } else if (error.responseJSON.message) {
                            errorMessage = error.responseJSON.message;
                        }
                    }
                    Swal.fire({
                        title: "Error",
                        text: errorMessage,
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });

        });

       
    });
</script>
<script>
   
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var copyText = document.getElementById("clipboardText");
        if (copyText) {
            navigator.clipboard.writeText(copyText.value).then(() => {
                showCopyToast();
            }).catch(err => console.error('Error copying text:', err));
        }
    });

    function showCopyToast() {
        var toastElement = document.getElementById("copyToast");
        var toast = new bootstrap.Toast(toastElement);
        toast.show();
    }
</script>

</x-app-layout>