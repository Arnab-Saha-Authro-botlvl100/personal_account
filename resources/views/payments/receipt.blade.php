<x-app-layout>
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

    <div class="container mt-4">
          <!-- Card Header -->
        <div class="card-header bg-primary text-dark text-center py-4">
            <h3 class="mb-0"><i class="fas fa-receipt me-2"></i> Payment Receipt</h3>
        </div>
        <div class="card shadow-lg border-0 rounded-lg" id="printable-section">
            <!-- Card Body -->
            <div class="card-body p-4">
                <div class="row">
                    <!-- Left Column: Customer & Contract Details -->
                    <div class="col-md-6 border-end pe-4">
                        <h5 class="fw-bold text-primary mb-4">Customer Details</h5>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Name:</strong> {{ $customer->name }}</p>
                            <p class="mb-1"><strong>ID:</strong> {{ $customer->customer_id }}</p>
                            <p class="mb-1">
                                <strong>Supplier Contract:</strong>
                                <span class="badge bg-info text-dark">{{ number_format($customer->agent_contract, 2) }} BDT</span>
                            </p>
                        </div>
    
                        <hr class="my-4">
    
                        <h5 class="fw-bold text-primary mb-4">Summary</h5>
                        <div class="mb-3">
                            <p class="mb-1">
                                <strong>Total Paid:</strong>
                                <span class="badge bg-success text-white">{{ number_format($totalPaid, 2) }} BDT</span>
                            </p>
                            <p class="mb-1">
                                <strong>Remaining Balance:</strong>
                                <span class="badge bg-danger text-white">{{ number_format($remaining, 2) }} BDT</span>
                            </p>
                        </div>
                    </div>
    
                    <!-- Right Column: Latest Transaction -->
                    <div class="col-md-6 ps-4">
                        <h5 class="fw-bold text-primary mb-4">Latest Transaction</h5>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Date:</strong> {{ \Carbon\Carbon::parse($latestPayment->date)->format('d-m-Y') }}</p>
                            <p class="mb-1">
                                <strong>Paid Amount:</strong>
                                <span class="badge bg-warning text-dark">{{ number_format($latestPayment->amount, 2) }} BDT</span>
                            </p>
                            <p class="mb-1"><strong>Transaction Method:</strong> {{ ucfirst($latestPayment->transaction_method) }}</p>
                            <p class="mb-1"><strong>Bank:</strong>
                                @php
                                    // Using the full namespace for the Transaction model
                                    $transaction = \App\Models\Transaction::where('id', $latestPayment->bank_name)->first();  // Use first() for a single result
                            
                                    // Check if the transaction exists
                                    $bank_name = $transaction->bank_name ?? 'N/A';
                                    $account_number = $transaction->account_number ?? 'N/A';
                                    $branch_name = $transaction->branch_name ?? 'N/A';
                                @endphp
                                <strong>Bank Name:</strong> {{ $bank_name }} <br>
                                <strong>Account Number:</strong> {{ $account_number }} <br>
                                <strong>Branch Name:</strong> {{ $branch_name }}
                            </p>                                                       
                            <p class="mb-1"><strong>Note:</strong> {{ $latestPayment->note ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
    
                <!-- Signature Section -->
                <div class="row mt-5">
                    <div class="col-md-6"></div> <!-- Empty space for alignment -->
                    <div class="col-md-6 text-end">
                        <hr class="mt-4 mb-2 w-50 ms-auto">
                        <p class="fw-bold">Authorized Signature</p>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Card Body -->
            <div class="card-body p-4">
                <div class="row">
                    <!-- Left Column: Customer & Contract Details -->
                    <div class="col-md-6 border-end pe-4">
                        <h5 class="fw-bold text-primary mb-4">Customer Details</h5>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Name:</strong> {{ $customer->name }}</p>
                            <p class="mb-1"><strong>ID:</strong> {{ $customer->customer_id }}</p>
                            <p class="mb-1">
                                <strong>Supplier Contract:</strong>
                                <span class="badge bg-info text-dark">{{ number_format($customer->agent_contract, 2) }} BDT</span>
                            </p>
                        </div>
    
                        <hr class="my-4">
    
                        <h5 class="fw-bold text-primary mb-4">Summary</h5>
                        <div class="mb-3">
                            <p class="mb-1">
                                <strong>Total Paid:</strong>
                                <span class="badge bg-success text-white">{{ number_format($totalPaid, 2) }} BDT</span>
                            </p>
                            <p class="mb-1">
                                <strong>Remaining Balance:</strong>
                                <span class="badge bg-danger text-white">{{ number_format($remaining, 2) }} BDT</span>
                            </p>
                        </div>
                    </div>
    
                    <!-- Right Column: Latest Transaction -->
                    <div class="col-md-6 ps-4">
                        <h5 class="fw-bold text-primary mb-4">Latest Transaction</h5>
                        <div class="mb-3">
                            <p class="mb-1"><strong>Date:</strong> {{ \Carbon\Carbon::parse($latestPayment->date)->format('d-m-Y') }}</p>
                            <p class="mb-1">
                                <strong>Paid Amount:</strong>
                                <span class="badge bg-warning text-dark">{{ number_format($latestPayment->amount, 2) }} BDT</span>
                            </p>
                            <p class="mb-1"><strong>Transaction Method:</strong> {{ ucfirst($latestPayment->transaction_method) }}</p>
                            <p class="mb-1"><strong>Bank:</strong>
                                @php
                                    // Using the full namespace for the Transaction model
                                    $transaction = \App\Models\Transaction::where('id', $latestPayment->bank_name)->first();  // Use first() for a single result
                            
                                    // Check if the transaction exists
                                    $bank_name = $transaction->bank_name ?? 'N/A';
                                    $account_number = $transaction->account_number ?? 'N/A';
                                    $branch_name = $transaction->branch_name ?? 'N/A';
                                @endphp
                                <strong>Bank Name:</strong> {{ $bank_name }} <br>
                                <strong>Account Number:</strong> {{ $account_number }} <br>
                                <strong>Branch Name:</strong> {{ $branch_name }}
                            </p>                                                       
                            <p class="mb-1"><strong>Note:</strong> {{ $latestPayment->note ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
    
                <!-- Signature Section -->
                <div class="row mt-5">
                    <div class="col-md-6"></div> <!-- Empty space for alignment -->
                    <div class="col-md-6 text-end">
                        <hr class="mt-4 mb-2 w-50 ms-auto">
                        <p class="fw-bold">Authorized Signature</p>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Footer with Actions -->
        <div class="card-footer text-center bg-light mt-4">
            <button onclick="printReceipt()" class="btn btn-success">
                <i class="fas fa-print me-2"></i> Print Receipt
            </button>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back
            </a>
        </div>
    </div>
    
        
    <!-- Print Functionality -->
    <script>
        function printReceipt() {
            // Clone the printable section
            const printContents = document.getElementById('printable-section').cloneNode(true);
    
            // Open a new window for printing
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Receive Receipt</title>');
            
            // Include Bootstrap CSS
            printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">');
            
            // Custom print styles
            printWindow.document.write(`
                <style>
                    @media print {
                        body {
                            margin: 0;
                            padding: 0;
                        }
                        .card {
                            border: none;
                            box-shadow: none;
                            width: 100% !important; /* Ensure card takes full width */
                        }
                        .row {
                            display: flex;
                            flex-wrap: wrap;
                        }
                        .col-md-6 {
                            width: 50% !important; /* Ensure columns take 50% width */
                            padding: 0 15px; /* Add padding for spacing */
                        }
                        .border-end {
                            border-right: 1px solid #dee2e6 !important;
                        }
                        .badge {
                            padding: 0.5em 0.75em;
                            font-size: 0.9em;
                        }
                        .text-primary {
                            color: #0d6efd !important;
                        }
                        .text-success {
                            color: #198754 !important;
                        }
                        .text-danger {
                            color: #dc3545 !important;
                        }
                        .text-warning {
                            color: #ffc107 !important;
                        }
                        .bg-gradient-primary {
                            background: linear-gradient(45deg, #0d6efd, #0b5ed7);
                        }
                        .bg-info {
                            background-color: #0dcaf0 !important;
                        }
                        .bg-success {
                            background-color: #198754 !important;
                        }
                        .bg-danger {
                            background-color: #dc3545 !important;
                        }
                        .bg-warning {
                            background-color: #ffc107 !important;
                        }
                    }
                </style>
            `);
            
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContents.innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
    
            // Print the receipt
            printWindow.print();
        }
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