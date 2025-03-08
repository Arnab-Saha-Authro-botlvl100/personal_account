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
        /* Styling for the chart headings */
        .chart-heading {
            font-family: 'Arial', sans-serif;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: linear-gradient(90deg, #4caf50, #2196f3);
            -webkit-background-clip: text;
            color: transparent;
        }

        /* Styling the canvas container */
        canvas {
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        #bankTransactionChart {
            height: 600px; /* Set a fixed height */
            overflow-y: auto;
        }

    </style>

    <style>
        .chart-container {
            position: relative;
            width: 100%;
            min-height: 300px; /* Set a minimum height for the chart container */
        }

        canvas {
            max-width: 100%;
            height: auto !important;
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
                    <!-- User Role Card -->
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="card text-white bg-success shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-center">Your Role</h5>
                                <p class="card-text text-center">{{ Auth::user()->role ?? 'User' }}</p>
                            </div>
                        </div>
                    </div>
                
                    <!-- Account Created Card -->
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="card text-white bg-info shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-center">Account Created</h5>
                                <p class="card-text text-center">{{ Auth::user()->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                
                    <!-- Financial Overview Card -->
                    <div class="col-lg-4 col-md-12 col-12 mb-3 d-flex">
                        <div class="card bg-warning text-white shadow-sm border-0 w-100">
                            <div class="card-body">
                                <h5 class="card-title mb-4 text-center">Financial Overview</h5>
                
                                <!-- Cash Receive -->
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-money-bill-wave" style="font-size: 2rem;"></i>
                                            <div>
                                                <h6 class="text-uppercase font-weight-bold mb-0">Cash Receive</h6>
                                                <p class="mb-0 font-weight-bold">৳ {{ number_format($totalCashReceive, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <!-- Bank Receive -->
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-university" style="font-size: 2rem;"></i>
                                            <div>
                                                <h6 class="text-uppercase font-weight-bold mb-0">Bank Receive</h6>
                                                <p class="mb-0 font-weight-bold">৳ {{ number_format($totalBankReceive, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <!-- Cash Payment -->
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-credit-card" style="font-size: 2rem;"></i>
                                            <div>
                                                <h6 class="text-uppercase font-weight-bold mb-0">Cash Payment</h6>
                                                <p class="mb-0 font-weight-bold">৳ {{ number_format($totalCashPayment, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <!-- Bank Payment -->
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <i class="fas fa-wallet" style="font-size: 2rem;"></i>
                                            <div>
                                                <h6 class="text-uppercase font-weight-bold mb-0">Bank Payment</h6>
                                                <p class="mb-0 font-weight-bold">৳ {{ number_format($totalBankPayment, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>
            

                <div class="row mt-3">
                    <div class="col-lg-6 col-md-12">
                        <h5 class="chart-heading text-center">Transaction Overview</h5>
                        <div class="chart-container">
                            <canvas id="transactionChart"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mt-3">
                        <h5 class="chart-heading text-center">Bank Transaction Overview</h5>
                        <div class="chart-container">
                            <canvas id="bankTransactionChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-3">
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
                    <div class="col-lg-8 col-12">
                        <h5 class="chart-heading text-center">Agent-wise Total Profit</h5>
                        <div class="chart-container">
                            <canvas id="agentProfitChart"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 mt-3">
                        <h5 class="chart-heading text-center">Supplier-wise Total Profit</h5>
                        <div class="chart-container">
                            <canvas id="supplierProfitChart"></canvas>
                        </div>
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
    
        // Assuming these variables are passed from your controller
        var totalCashReceive = @json($totalCashReceive);
        var totalCashPayment = @json($totalCashPayment);
        var totalBankReceive = @json($totalBankReceive);
        var totalBankPayment = @json($totalBankPayment);
    
        // Set labels for the chart
        var labels = ['Cash Receive', 'Cash Payment', 'Bank Receive', 'Bank Payment'];
    
        // Initialize the new chart
        window.transactionChart = new Chart(ctx2, {
            type: 'line', // Change type to 'line'
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Cash Receive',
                    data: [totalCashReceive, 0, 0, 0],
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: 'Total Cash Payment',
                    data: [0, totalCashPayment, 0, 0],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Total Bank Receive',
                    data: [0, 0, totalBankReceive, 0],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Total Bank Payment',
                    data: [0, 0, 0, totalBankPayment],
                    backgroundColor: 'rgba(255, 205, 86, 0.5)',
                    borderColor: 'rgba(255, 205, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Enable responsiveness
                maintainAspectRatio: false, // Allow the chart to resize freely
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
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top', // Position the legend at the top
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('supplierProfitChart').getContext('2d');
        var supplierProfitChart = new Chart(ctx, {
            type: 'doughnut', // Doughnut chart type
            data: {
                labels: @json($supplierProfits->pluck('supplier_name')), // Supplier names
                datasets: [{
                    label: 'Supplier-wise Total Profit',
                    data: @json($supplierProfits->pluck('total_profit')), // Profit per supplier
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)', 
                        'rgba(54, 162, 235, 0.5)', 
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)'
                    ], // Multiple colors for different segments
                    borderColor: [
                        'rgba(255, 99, 132, 1)', 
                        'rgba(54, 162, 235, 1)', 
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ], // Border colors
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Enable responsiveness
                maintainAspectRatio: false, // Allow the chart to resize freely
                plugins: {
                    legend: {
                        position: 'top', // Position the legend at the top
                    },
                    title: {
                        display: true,
                        text: 'Supplier-wise Total Profit' // Add a title to the chart
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('agentProfitChart').getContext('2d');
        var agentProfitChart = new Chart(ctx, {
            type: 'line', // Change to 'radar' for radar chart
            data: {
                labels: @json($agentProfits->pluck('agent_name')), // Agent names
                datasets: [{
                    label: 'Agent-wise Total Profit',
                    data: @json($agentProfits->pluck('total_profit')), // Profit per agent
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Light red for the area
                    borderColor: 'rgba(255, 99, 132, 1)', // Red for the border
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)', // Points color
                    fill: true // Fill the area under the line
                }]
            },
            options: {
                responsive: true, // Enable responsiveness
                maintainAspectRatio: false, // Allow the chart to resize freely
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Agent Name' // X-axis title
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Profit' // Y-axis title
                        },
                        beginAtZero: true // Start Y-axis from zero
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top', // Position the legend at the top
                    },
                    title: {
                        display: true,
                        text: 'Agent-wise Total Profit' // Chart title
                    }
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('bankTransactionChart').getContext('2d');

        // Pass the PHP variable to JavaScript
        var chartData = @json($chartData);

        // Extract labels and data from chartData
        var labels = chartData.map(function (item) {
            return item.bank_name;
        });

        var receiveTotals = chartData.map(function (item) {
            return item.receive_total;
        });

        var paymentTotals = chartData.map(function (item) {
            return item.payment_total;
        });

        // Initialize the chart
        var bankTransactionChart = new Chart(ctx, {
            type: 'bar', // Use 'bar' for a bar chart
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Receive Total',
                        data: receiveTotals,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)', // Light green
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Payment Total',
                        data: paymentTotals,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)', // Light red
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true, // Enable responsiveness
                maintainAspectRatio: false, // Allow the chart to resize freely
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bank Name' // X-axis title
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total Amount' // Y-axis title
                        },
                        beginAtZero: true // Start Y-axis from zero
                    }
                },
                plugins: {
                    legend: {
                        position: 'top', // Position the legend at the top
                    },
                    title: {
                        display: true,
                        text: 'Bank Transaction Overview' // Chart title
                    }
                }
            }
        });
        });
    </script>

</x-app-layout>
