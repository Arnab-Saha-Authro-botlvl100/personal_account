<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
 
    <style>
        .hide-scroll-bar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .hide-scroll-bar::-webkit-scrollbar {
            display: none;
        }
    </style>
    <style>
        @media (max-width: 768px) {
            .table-responsive table {
                font-size: 12px;
                /* Adjust font size for small screens */
            }
        }
    </style>
    <style>
        .custom-btn {
            font-weight: bold;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .custom-btn-primary {
            background-color: #007bff;
            color: white;
        }
        .custom-btn-primary:hover {
            background-color: #0056b3;
        }
        .custom-btn-dark {
            background-color: #343a40;
            color: white;
        }
        .custom-btn-dark:hover {
            background-color: #23272b;
        }
    </style>
</head>

<body class="flex">

    <main class="flex-1 mx-auto max-w-7xl px-10">
        <div class="d-flex justify-content-between align-item-center gap-3 shadow-lg p-5">
           
            <button class="custom-btn custom-btn-primary" onclick="printDiv('printable-part')">Print</button>
            <button class="custom-btn custom-btn-dark" onclick="window.history.back();">GO BACK</button>

        </div>
        {{-- <div class="container-fluid shadow-lg p-5 mt-4" id="printable-part">
            <h2 class="text-center font-bold text-3xl my-2">Cash Book</h2>
            <div class="flex items-center justify-between mb-2">
                <div class="text-lg">
                    <h2 class="font-semibold">Company Name : {{ Auth::user()->name }}</h2>
                    <p><span class="font-semibold">Period Date :</span> {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} to {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }} </p>
                </div>
                <div class="flex items-start flex-column">
                    <h2 class="font-semibold">Email : {{ Auth::user()->email }}<br>Phone: {{ Auth::user()->phone }}</h2>
                    <p><span class="font-semibold">Address :</span> {{Auth::user()->address}}</p>
                </div>
            </div>
            <div class="table-responsive" id="">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>From/To</th>
                            <th>Purpose</th>
                            <th>Method</th>
                            <th>Bank Name</th>
                            <th>Receive</th>
                            <th>Payment</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-right table-warning">
                            <td colspan="7" class="text-end"><strong>Opening Balance:</strong></td>
                            <td class="text-start"><strong> {{ number_format($opening_balance, 2) }}</strong></td>
                        </tr>
                        @php
                            $currentBalance = $opening_balance; // Start with the opening balance
                        @endphp
                        @foreach ($mergedData as $transaction)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d-m-Y') }}</td>
                                <td>{{ $transaction->customer_name }}</td>
                                <td>{{ $transaction->note }}</td>
                                <td>{{ $transaction->transaction_method }}</td>
                                <td>
                                    @if ($transaction->transaction_method == 'cash')
                                        Cash
                                    @else
                                        {{ $getBankName($transaction->bank_name) ?? 'Unknown Bank' }}
                                    @endif
                                </td>
                                <td>
                                    @if ($transaction instanceof App\Models\Receive)
                                        {{ number_format($transaction->amount, 2) }}
                                        @php
                                            $currentBalance += $transaction->amount; // Add to balance
                                        @endphp
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($transaction instanceof App\Models\Payment)
                                        {{ number_format($transaction->amount, 2) }}
                                        @php
                                            $currentBalance -= $transaction->amount; // Subtract from balance
                                        @endphp
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    {{ number_format($currentBalance, 2) }} <!-- Display current balance -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-secondary">
                            <th colspan="5" class="text-end">Total</th>
                            <th>{{ number_format($totalDebit, 2) }}</th>
                            <th>{{ number_format($totalCredit, 2) }}</th>
                            <th>{{ number_format($currentBalance, 2) }} </th>
                        </tr>
                        <tr class="table-dark">
                            <th colspan="7" class="text-start">Closing Balance</th>
                            <th>{{ number_format($currentBalance, 2) }} </th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div> --}}
        <div class="container-fluid shadow-lg p-5 mt-4" id="printable-part">
            <!-- Title -->
            <h2 class="text-center font-weight-bold text-xl my-4 text-dark">Cash Book</h2>
            
            <!-- Company Information -->
            <div class="d-flex justify-content-between mb-4">
                <div class="text-lg">
                    <h3 class="font-semibold text-dark">Company Name: {{ Auth::user()->name }}</h3>
                    <p><span class="font-semibold">Period Date:</span> {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} to {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</p>
                </div>
                <div class="text-lg text-right">
                    <h3 class="font-semibold text-dark">Email: {{ Auth::user()->email }}<br>Phone: {{ Auth::user()->phone }}</h3>
                    <p><span class="font-semibold">Address:</span> {{ Auth::user()->address }}</p>
                </div>
            </div>
       
            <!-- Table Section -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark bg-dark">
                        <tr>
                            <th>Date</th>
                            <th>From/To</th>
                            <th>Purpose</th>
                            <th>Method</th>
                            <th>Bank Name</th>
                            <th>Receive</th>
                            <th>Payment</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Opening Balance Row -->
                        <tr class="text-right table-warning">
                            <td colspan="7" class="text-start"><strong>Opening Balance:</strong></td>
                            <td class="text-start"><strong>{{ number_format($opening_balance, 2) }}</strong></td>
                        </tr>
        
                        @php
                            $currentBalance = $opening_balance; // Start with the opening balance
                        @endphp
        
                        <!-- Transaction Rows -->
                        @foreach ($mergedData as $transaction)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d-m-Y') }}</td>
                                <td>{{ $transaction->customer_name }}</td>
                                <td>{{ $transaction->note }}</td>
                                <td>{{ ucfirst($transaction->transaction_method) }}</td>
                                <td>
                                    @if ($transaction->transaction_method == 'cash')
                                        <!-- Handle the cash transaction case if necessary -->
                                    @else
                                        <div>
                                            <p><strong>Bank Name:</strong> {{ $getBankDetails($transaction->bank_name)['bank_name'] ?? 'Unknown Bank' }}</p>
                                            <p><strong>Account Number:</strong> {{ $getBankDetails($transaction->bank_name)['account_number'] ?? '' }}</p>
                                            <p><strong>Branch Name:</strong> {{ $getBankDetails($transaction->bank_name)['branch_name'] ?? '' }}</p>
                                        </div>
                                    @endif
                                </td>
                                
                                <td>
                                    @if ($transaction instanceof App\Models\Receive)
                                        {{ number_format($transaction->amount, 2) }}
                                        @php
                                            $currentBalance += $transaction->amount; // Add to balance
                                        @endphp
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($transaction instanceof App\Models\Payment)
                                        {{ number_format($transaction->amount, 2) }}
                                        @php
                                            $currentBalance -= $transaction->amount; // Subtract from balance
                                        @endphp
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ number_format($currentBalance, 2) }}</td> <!-- Display current balance -->
                            </tr>
                        @endforeach
                    </tbody>
        
                    <tfoot>
                        <tr class="table-secondary">
                            <th colspan="5" class="text-end">Total</th>
                            <th>{{ number_format($totalDebit, 2) }}</th>
                            <th>{{ number_format($totalCredit, 2) }}</th>
                            <th>{{ number_format($currentBalance, 2) }} </th>
                        </tr>
        
                      <!-- Closing Balance Row -->
                        <tr class="" style="font-size: 20px; background-color: #007bff!important; color: white;">
                            <th colspan="7" class="text-start" style="font-weight: bold;">Closing Balance</th>
                            <th class="font-weight-bold" style="font-size: 20px;">{{ number_format($currentBalance, 2) }} </th>
                        </tr>

                    </tfoot>
                </table>
            </div>
        </div>
        
        

    </main>
   
    <script>
        function printDiv(divId) {
            var printContent = document.getElementById(divId).innerHTML; // Get the content of the div
            var originalContent = document.body.innerHTML; // Save the original content
        
            // Create a new window for printing
            var printWindow = window.open('', '', 'height=600,width=800');
        
            // Write the content and styles to the new window
            printWindow.document.write('<html><head><title>Print</title>');
        
            // Copy all styles from the current document (or you can include specific styles)
            var styles = '';
            var styleSheets = document.styleSheets;
            for (var i = 0; i < styleSheets.length; i++) {
                try {
                    var rules = styleSheets[i].cssRules || styleSheets[i].rules;
                    for (var j = 0; j < rules.length; j++) {
                        styles += rules[j].cssText;
                    }
                } catch (e) {
                    // Handle cross-origin stylesheets, if necessary
                }
            }
        
            // Include the styles inside the print window
            printWindow.document.write('<style>' + styles + '</style>');
        
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContent); // Insert the content of the div
            printWindow.document.write('</body></html>');
        
            // Wait for the content to load and then trigger the print dialog
            printWindow.document.close(); // Close the document for further editing
            printWindow.focus(); // Focus on the window before printing
            printWindow.print(); // Trigger the print dialog
            printWindow.close(); // Close the print window after printing
        }
    </script>
    
</body>

</html>
