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
    <style>
        /* Container for the search form */
        .search-from {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 1200px;
        }

        /* Form container */
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: flex-start;
        }

        /* Form group (each input/select container) */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
            width: calc(50% - 8px);
            /* 2 columns for medium screens */
        }

        /* Labels */
        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #22262e;
        }

        /* Required asterisk */
        .required {
            color: red;
        }

        /* Checkbox container */
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Checkbox label */
        .checkbox-label {
            font-size: 14px;
            color: #22262e;
        }

        /* Inputs and selects */
        .form-input,
        .form-select {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            color: #22262e;
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            outline: none;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        /* Submit button */
        .submit-button {
            background-color: black;
            color: white;
            font-size: 14px;
            font-weight: 700;
            padding: 8px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #333;
        }
        .button-row {
            display: flex;
            gap: 10px; /* Space between buttons */
            align-items: center;
            justify-content: flex-start; /* Align buttons to the left */
            width: 100%; /* Full width */
            flex-direction: row;
        }
        /* Style for disabled dropdowns */
        select:disabled {
            background-color: #f0f0f0;
            cursor: not-allowed;
            opacity: 0.7;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-group {
                width: 100%;
                /* Full width on smaller screens */
            }
        }
        /* Apply the styles you need for printing */
        @media print {
            #printsection {
                font-family: Arial, sans-serif;
                font-size: 12pt;
                color: black;
                background-color: white;
                margin: 20px;
            }
        }

    </style>
    @include('layouts.links')

    <div class="container-fluid" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" style="width: 100%;">
            <div class="container-fluid" id="initial-div">
                <div class="search-from">
                    <form autocomplete="off" id="reportForm" action="" method="POST" class="container mt-4">
                        @csrf
                        <div class="form-container">
                            <!-- "All" Checkbox -->
                            <div class="form-group">
                                <label for="select_all" class="form-label">
                                    All
                                </label>
                                <div class="checkbox-container">
                                    <input type="checkbox" name="select_all" id="select_all" checked class="form-checkbox">
                                    <label for="select_all" class="checkbox-label">Select All</label>
                                </div>
                            </div>
                
                            <!-- Customer -->
                            <div class="form-group">
                                <label for="customer" class="form-label">
                                    Select Customer
                                </label>
                                <select name="customer" id="customer" class="form-select">
                                    <option value="">Select One</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }} <span style="font-weight: bold; color:teal">({{$customer->customer_id}})</span></option>
                                    @endforeach
                                
                                </select>
                            </div>
                
                            <!-- Agent -->
                            <div class="form-group">
                                <label for="agent" class="form-label">
                                    Select Agent
                                </label>
                                <select name="agent" id="agent" class="form-select">
                                    <option value="">Select One</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <!-- Supplier -->
                            <div class="form-group">
                                <label for="supplier" class="form-label">
                                    Select Supplier
                                </label>
                                <select name="supplier" id="supplier" class="form-select">
                                    <option value="">Select One</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <!-- Start Date -->
                            <div class="form-group">
                                <label for="start_date" class="form-label">From</label>
                                <input type="date" name="start_date" id="start_date" class="form-input" placeholder="Start Date" />
                            </div>
                
                            <!-- End Date -->
                            <div class="form-group">
                                <label for="end_date" class="form-label">To</label>
                                <input type="date" name="end_date" id="end_date" class="form-input" placeholder="End Date" />
                            </div>
                
                            <!-- Buttons Row -->
                            <div class="form-group button-row">
                                <button type="submit" id="submit-btn" class="btn btn-success">
                                    Submit
                                </button>
                                <button type="button" id="print-btn" class="btn btn-primary">
                                    <i class="fas fa-print"></i> Print
                                </button>
                                <button type="button" id="download-btn" class="btn btn-info">
                                    <i class="fas fa-download"></i> Download
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="printsection" class="table-responsive container mt-4">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Date</th>
                                <th>Invoice/Customer ID/Type</th>
                                <th>Details</th>
                                <th>Agent Contact</th>
                                <th>Supplier Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sorted as $item)
                                @if ($item->getTable() == 'customers')
                                    <tr class="table-customer bg-info-subtle">
                                        <td>
                                            <span
                                                class="badge bg-info text-white text-uppercase fw-bold">Customer</span><br>
                                            {{ $item->created_at->format('d-m-y') }}
                                        </td>
                                        <td>{{ $item->customer_id }}</td>
                                        <td>
                                            <strong>{{ $item->name }}</strong><br>
                                            📞 {{ $item->phone_number }}<br>
                                            🛂 {{ $item->passport_number }}
                                        </td>
                                        <td><strong class="text-success">{{ $item->agent_contract }}</strong></td>
                                        <td><strong class="text-danger">{{ $item->supplier_contract }}</strong></td>
                                    </tr>
                                @elseif($item->getTable() == 'receives')
                                    <tr class="table-receive bg-success-subtle">
                                        <td>
                                            <span
                                                class="badge bg-success text-white text-uppercase fw-bold">Receive</span><br>
                                            {{ $item->created_at->format('d-m-y') }}
                                        </td>
                                        <td>{{ $item->receive_type }}</td>
                                        <td>
                                            <strong>{{ $item->contract_invoice }}/{{ $item->customer_name }}</strong><br>
                                            🏦 {{ $item->transaction_method }}<br>
                                            🏛 {{ $item->transaction_bank_name }}<br>
                                            💳 {{ $item->account_number }}/ {{ $item->branch_name }}<br>
                                            📝 {{ $item->note }}
                                        </td>
                                        <td><strong class="text-success">{{ $item->amount }}</strong></td>
                                        <td>N/A</td>
                                    </tr>
                                @elseif($item->getTable() == 'payments')
                                    <tr class="table-payment bg-danger-subtle">
                                        <td>
                                            <span
                                                class="badge bg-danger text-white text-uppercase fw-bold">Payment</span><br>
                                            {{ $item->created_at->format('d-m-y') }}
                                        </td>
                                        <td>{{ $item->receive_type }}</td>
                                        <td>
                                            <strong>{{ $item->contract_invoice }}/{{ $item->customer_name }}</strong><br>
                                            💳 {{ $item->transaction_method }}<br>
                                            🏛 {{ $item->transaction_bank_name }}<br>
                                            🔢 {{ $item->account_number }}/ {{ $item->branch_name }}<br>
                                            📝 {{ $item->note }}
                                        </td>
                                        <td>N/A</td>
                                        <td><strong class="text-danger">{{ $item->amount }}</strong></td>
                                    </tr>
                                @elseif($item->getTable() == 'tickets')
                                    <tr class="table-ticket bg-warning-subtle">
                                        <td>
                                            <span
                                                class="badge bg-warning text-dark text-uppercase fw-bold">Ticket</span><br>
                                            {{ $item->flight_date->format('d-m-y') }}
                                        </td>
                                        <td>{{ $item->ticket_no }}</td>
                                        <td>
                                            ✈️ {{ $item->flight_no }}<br>
                                            🏷️ {{ $item->airline }} / PNR {{ $item->pnr_no }}<br>
                                            📍 {{ $item->sector }}
                                        </td>
                                        <td><strong class="text-warning">{{ $item->debit }}</strong></td>
                                        <td><strong class="text-primary">{{ $item->credit }}</strong></td>
                                    </tr>
                                @elseif($item->getTable() == 'contracts')
                                    <tr class="table-contract bg-secondary-subtle">
                                        <td>
                                            <span
                                                class="badge bg-secondary text-white text-uppercase fw-bold">Contract</span><br>
                                            {{ $item->date->format('d-m-y') }}
                                        </td>
                                        <td>{{ $item->invoice_no }}</td>
                                        <td>
                                            👤 Agent: <strong>{{ $item->agent_name }}</strong><br>
                                            🚛 Supplier: <strong>{{ $item->supplier_name }}</strong><br>
                                            👨‍💼 Customer: <strong>{{ $item->customer_name }}</strong>
                                        </td>
                                        <td><strong class="text-success">{{ $item->agent_price }}</strong></td>
                                        <td><strong class="text-danger">{{ $item->supplier_price }}</strong></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Get references to the dropdowns
            const $customerDropdown = $("#customer");
            const $agentDropdown = $("#agent");
            const $supplierDropdown = $("#supplier");
    
            // Add event listener to the Customer dropdown
            $customerDropdown.on("change", function () {
                if ($(this).val() !== "") {
                    // If a customer is selected, disable Agent and Supplier dropdowns
                    $agentDropdown.prop("disabled", true);
                    $supplierDropdown.prop("disabled", true);
                } else {
                    // If no customer is selected, enable Agent and Supplier dropdowns
                    $agentDropdown.prop("disabled", false);
                    $supplierDropdown.prop("disabled", false);
                }
            });
    
            // Add event listener to the Agent dropdown
            $agentDropdown.on("change", function () {
                if ($(this).val() !== "") {
                    // If an agent is selected, disable Customer dropdown
                    $customerDropdown.prop("disabled", true);
                } else {
                    // If no agent is selected, enable Customer dropdown
                    $customerDropdown.prop("disabled", false);
                }
            });
    
            // Add event listener to the Supplier dropdown
            $supplierDropdown.on("change", function () {
                if ($(this).val() !== "") {
                    // If a supplier is selected, disable Customer dropdown
                    $customerDropdown.prop("disabled", true);
                } else {
                    // If no supplier is selected, enable Customer dropdown
                    $customerDropdown.prop("disabled", false);
                }
            });
        });
    </script>

    <!-- AJAX Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

    <script>
        $(document).ready(function() {
            $("#reportForm").submit(function(e) {
                e.preventDefault(); // Prevent normal form submission
    
                var formData = $(this).serialize(); // Serialize form data
    
                $.ajax({
                    url: "{{ route('report.general_ledger_modified') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $('#printsection').html('');
                        $('#printsection').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = "Something went wrong!";
                        
                        // Try to parse and extract error message
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            errorMessage = xhr.responseText;
                        }
    
                        // Show SweetAlert error message
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: errorMessage,
                            confirmButtonColor: "#d33"
                        });
    
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
   <!-- Include html2pdf.js Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        // Print Function
        $('#print-btn').click(function () {
            var printContent = document.getElementById('printsection');
            var newWindow = window.open('', '', 'width=800,height=600');
            newWindow.document.write('<html><head><title>Print</title>');
            
            // Include external CSS (styles from the page)
            var styles = document.getElementsByTagName('style');
            for (var i = 0; i < styles.length; i++) {
                newWindow.document.write('<style>' + styles[i].innerHTML + '</style>');
            }

            // Or include an external stylesheet
            // newWindow.document.write('<link rel="stylesheet" href="path-to-your-stylesheet.css">');

            newWindow.document.write('</head><body>');
            newWindow.document.write(printContent.innerHTML);
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        });

        // Download as PDF with Styles
        $('#download-btn').click(function () {
            var element = document.getElementById('printsection');

            // Use html2pdf.js with the option to include styles
            html2pdf()
                .from(element)
                .set({
                    html2canvas: {
                        scale: 2,
                        logging: true,
                        letterRendering: true,
                    },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                })
                .save('report.pdf');
        });
    });
</script>


    
</x-app-layout>
