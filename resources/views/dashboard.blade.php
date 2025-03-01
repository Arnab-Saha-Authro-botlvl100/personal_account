<x-app-layout>
    <style>
        body{
            /* overflow-x: hidden;  */
        }
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
        #main-content{
            margin-left: 100px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- @include('layouts.links', ['notificationCount' => $notificationCount]) --}}
    @include('layouts.links')

    <!-- Page Content Wrapper -->
    <div class="container-fluid" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" style="width: 80%;">
            <div class="container-fluid py-4">
                <div class="row">
                    <!-- Welcome Message -->
                    <div class="col-lg-12">
                        <div class="alert alert-primary shadow-sm rounded-3 d-flex justify-content-between align-items-center flex-wrap">
                            <!-- Left Side: Welcome Message -->
                            <div class="mb-2 mb-md-0">
                                <h4 class="mb-1">👋 Welcome back, {{ Auth::user()->name }}!</h4>
                                <p class="mb-0">Today is <span id="current-date"></span>. Have a productive day! 🚀</p>
                            </div>
                
                            <!-- Right Side: Real-Time Clock -->
                            <div class="text-end mb-2 mb-md-0">
                                <h5 class="mb-1"><i class="fas fa-clock"></i> Current Time</h5>
                                <p class="mb-0 fw-bold" id="real-time-clock"></p>
                            </div>
                        </div>
                    </div>
                </div>
                
            
                <!-- User Info & Quick Summary -->
                <div class="row mt-3">
                    <div class="col-md-4 col-12 mb-3">
                        <div class="card text-white bg-success shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Your Role</h5>
                                <p class="card-text">{{ Auth::user()->role ?? 'User' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mb-3">
                        <div class="card text-white bg-info shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Account Created</h5>
                                <p class="card-text">{{ Auth::user()->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                        </div>
                    </div>                    
                    <div class="col-md-4 col-12 mb-3">
                        <div class="card text-white bg-warning shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Financial Overview</h5>
                                <p class="card-text">
                                    💵 <strong>Cash Transactions:</strong> ৳ {{ number_format($totalCash, 2) }} <br>
                                    🏦 <strong>Bank Transactions:</strong> ৳ {{ number_format($totalBank, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>                    
                </div>
                

                <div class="row mt-3">
                    <div class="col-md-6 col-12">
                        <canvas id="transactionChart"></canvas>
                    </div>
                    <div class="col-md-6 col-12">
                        <canvas id="bankTransactionChart"></canvas>
                    </div>
                </div>

                <div class="row">
                    @if ($lowBalanceAccounts->count() > 0)
                        <div class="alert alert-danger">
                            ⚠️ Warning: Some accounts have a low balance! 
                            <ul>
                                @foreach ($lowBalanceAccounts as $account)
                                    <li>{{ $account->bank_name }} - ৳ {{ number_format($account->amount, 2) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 col-12">
                        <canvas id="agentProfitChart"></canvas>
                    </div>
                    <div class="col-md-6 col-12">
                        <canvas id="supplierProfitChart"></canvas>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>


    
    <div id="message" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">

        <!-- Logged in Message -->
        @if (session('logged_in'))
            <div style="background-color: #50e233;" class="shadow-lg rounded p-4 text-white mb-2">
                <b>{{ session('logged_in') }}</b>
            </div>
        @endif

        <!-- Success Message -->
        @if (session('success'))
            <div style="background-color: #50e233;" class="shadow-lg rounded p-4 text-white">
                <b>{{ session('success') }}</b>
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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
    <script>
        function updateClock() {
            let now = new Date();
            let timeString = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
            document.getElementById('real-time-clock').innerText = timeString;
        }
        
        function updateDate() {
            let today = new Date();
            let dateString = today.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            document.getElementById('current-date').innerText = dateString;
        }
    
        updateDate(); // Set initial date
        setInterval(updateClock, 1000); // Update time every second
    </script>
    
    {{-- cash and bank --}}
    <script>
        var ctx2 = document.getElementById('transactionChart').getContext('2d');
    
        // Destroy the existing chart if it exists
        if (window.transactionChart instanceof Chart) {
            window.transactionChart.destroy();
        }
    
        // Grouping data by transaction type
        var transactionTypes = @json($monthlyTransactions->pluck('transaction_type'));
        var totals = @json($monthlyTransactions->pluck('total'));
    
        // Initialize the new chart
        window.transactionChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: transactionTypes, // Set labels to transaction types
                datasets: [{
                    label: 'Monthly Transactions',
                    data: totals, // Set data to total amounts
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Transaction Type'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Amount'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('supplierProfitChart').getContext('2d');
        var supplierProfitChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($supplierProfits->pluck('supplier_name')), // X-axis: Supplier names
                datasets: [{
                    label: 'Supplier-wise Total Profit',
                    data: @json($supplierProfits->pluck('total_profit')), // Profit per supplier
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('agentProfitChart').getContext('2d');
        var agentProfitChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($agentProfits->pluck('agent_name')), // X-axis: Agent names
                datasets: [{
                    label: 'Agent-wise Total Profit',
                    data: @json($agentProfits->pluck('total_profit')), // Profit per agent
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            }
        });
    </script>


    <script>
        var ctx1 = document.getElementById('bankTransactionChart').getContext('2d');

        // Destroy the existing chart if it exists
        if (window.bankTransactionChart instanceof Chart) {
            window.bankTransactionChart.destroy();
        }

        // Group data by transaction type and bank name
        var transactionData = @json($monthlyTransactions_2->groupBy(['transaction_type', 'bank_name']));

        // Function to generate dynamic colors
        function getColor(index) {
            var colors = [
                'rgba(255, 99, 132, 1)',    // Red
                'rgba(54, 162, 235, 1)',    // Blue
                'rgba(75, 192, 192, 1)',    // Teal
                'rgba(255, 159, 64, 1)',    // Orange
                'rgba(153, 102, 255, 1)',   // Purple
                'rgba(255, 205, 86, 1)',    // Yellow
                'rgba(201, 203, 207, 1)'    // Gray
            ];
            return colors[index % colors.length];
        }

        // Function to get month name from month number
        function getMonthName(monthNumber) {
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            return months[monthNumber - 1];
        }

        // Create labels for all 12 months
        var monthLabels = Array.from({ length: 12 }, (_, i) => getMonthName(i + 1));

        var datasets = [];
        var colorIndex = 0;

        Object.keys(transactionData).forEach(function(transactionType) {
            Object.keys(transactionData[transactionType]).forEach(function(bankName) {
                var transactions = transactionData[transactionType][bankName];

                // Create a map of month to receive and payment totals
                var monthToReceiveMap = {};
                var monthToPaymentMap = {};
                transactions.forEach(t => {
                    if (t && t.month) { // Check if t is not null and has a month property
                        monthToReceiveMap[t.month] = t.receive_total || 0;
                        monthToPaymentMap[t.month] = t.payment_total || 0;
                    }
                });

                // Fill in missing months with 0
                var receiveData = monthLabels.map((_, index) => ({
                    x: getMonthName(index + 1),
                    y: monthToReceiveMap[index + 1] || 0
                }));

                var paymentData = monthLabels.map((_, index) => ({
                    x: getMonthName(index + 1),
                    y: monthToPaymentMap[index + 1] || 0
                }));

                // Add receive dataset
                datasets.push({
                    label: `${bankName || 'Cash'} - Receive (${transactionType})`, // Label for receive
                    data: receiveData,
                    borderColor: getColor(colorIndex),
                    backgroundColor: getColor(colorIndex).replace('1)', '0.2)'),
                    borderWidth: 2,
                    pointRadius: 5,
                    fill: false,
                    tension: 0.3
                });

                // Add payment dataset
                datasets.push({
                    label: `${bankName || 'Cash'} - Payment (${transactionType})`, // Label for payment
                    data: paymentData,
                    borderColor: getColor(colorIndex + 1),
                    backgroundColor: getColor(colorIndex + 1).replace('1)', '0.2)'),
                    borderWidth: 2,
                    pointRadius: 5,
                    fill: false,
                    tension: 0.3
                });

                colorIndex += 2; // Increment color index for the next bank/cash
            });
        });

        // Initialize the new chart
        window.bankTransactionChart = new Chart(ctx1, {
            type: 'line', // Change to 'bar' if you want a bar chart
            data: {
                labels: monthLabels, // X-axis: All 12 months
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ৳' + context.raw.y;
                            }
                        }
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            padding: 20
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Transactions (৳)'
                        },
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(200, 200, 200, 0.3)'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
