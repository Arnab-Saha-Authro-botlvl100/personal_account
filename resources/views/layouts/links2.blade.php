<style>
    body{
        overflow-x: hidden;
    }
    /* Sidebar Styling */
    .sidebar {
      width: 250px;
      height: 100vh;
      position: fixed;
      top: 50px;
      left: 0;
      background: #6c859e;
      color: white;
      padding: 15px;
      overflow-y: auto;
      transition: 0.3s; /* Smooth transition for sidebar */
    }
  
    .main-container {
      /* margin-left: 250px; Pushes content to the right of the sidebar */
      padding: 20px; /* Optional: Adds some spacing */
      transition: 0.3s; /* Smooth transition for main content */
   
    }
  
    /* If sidebar is collapsed */
    .collapsed .sidebar {
      width: 60px; /* Collapsed sidebar width */
    }
  
    .collapsed .main-container {
      margin-left: 60px; /* Adjust main content margin for collapsed sidebar */
    }
  
    /* When sidebar is fully hidden */
    .sidebar-hidden .sidebar {
      width: 0; /* Hide sidebar completely */
    }
  
    .sidebar-hidden .main-container {
      margin-left: 0; /* Remove margin to restore original shape */
    }
    
</style>
<style>
    /* Base styling for nav links */
    .nav-link {
      padding: 10px 15px; /* Add padding for better spacing */
      border-radius: 5px; /* Rounded corners */
      transition: background-color 0.3s, color 0.3s; /* Smooth transition */
      color: #ffffff; /* Default text color */
      display: flex;
      align-items: center; /* Align icon and text vertically */
      gap: 10px; /* Space between icon and text */
    }
  
    /* Hover effect for nav links */
    .nav-link:hover {
      background-color: #495057; /* Darker background on hover */
      color: #fff !important; /* Ensure text remains white */
    }
  
    /* Active state for nav links */
    .nav-link.active {
      background-color: #0d6efd; /* Bootstrap primary color for active state */
      color: #fff !important;
    }
  
    /* Dropdown toggle arrow alignment */
    .dropdown-toggle::after {
      margin-left: auto; /* Align dropdown arrow to the right */
    }
  
    /* Styling for dropdown menus */
    .collapse ul {
      margin-left: 20px; /* Indent dropdown items */
      list-style: none; /* Remove default list styling */
      padding-left: 0; /* Remove default padding */
    }
  
    /* Styling for dropdown items */
    .collapse ul .nav-link {
      padding: 8px 15px; /* Slightly smaller padding for dropdown items */
      background-color: transparent; /* Transparent background */
      border-radius: 4px; /* Slightly rounded corners */
    }
  
    /* Hover effect for dropdown items */
    .collapse ul .nav-link:hover {
      background-color: #343a40; /* Darker background on hover */
    }
  
    /* Active state for dropdown items */
    .collapse ul .nav-link.active {
      background-color: #0d6efd; /* Bootstrap primary color for active state */
    }
  
    /* Optional: Add a border to separate dropdown items */
    .collapse ul .nav-link {
      border-bottom: 1px solid #444; /* Subtle border between items */
    }
  
    /* Remove border from the last dropdown item */
    .collapse ul .nav-link:last-child {
      border-bottom: none;
    }
  
    /* Optional: Add a transition effect for dropdown items */
    .collapse ul .nav-link {
      transition: background-color 0.2s, color 0.2s;
    }
</style>

<!-- Sidebar -->
<div class="sidebar" id="sidebar" style="width: 250px; transition: 0.3s;">
    <a href="#" class="d-flex align-items-center mb-3 text-white text-decoration-none">
        <i class="fas fa-bars me-2" id="sidebarToggle" style="cursor: pointer;"></i>
    </a>
    <hr>

    <ul class="nav nav-pills flex-column mb-auto" style="margin-left: 30px">
        <!-- Add Service -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#servicemodal">
                <i class="fas fa-tools me-2"></i> Add Service
            </a>
        </li>
    
        <!-- Add Agent -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-user-tie me-2"></i> Add Agent
            </a>
        </li>
    
        <!-- Add Supplier -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#supplierModal">
                <i class="fas fa-truck me-2"></i> Add Supplier
            </a>
        </li>
    
        <!-- Add Customer -->
        <li class="nav-item">
            <a href="{{ route('customers.create') }}" class="nav-link text-white d-flex align-items-center">
                <i class="fas fa-user-plus me-2"></i> Add Customer
            </a>
        </li>
    
        <!-- Payments Dropdown -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#paymentMenu">
                <i class="fas fa-wallet me-2"></i> Receive/Payment
            </a>
            <div class="collapse" id="paymentMenu">
                <ul class="nav flex-column ms-4">
                    <li class="nav-item">
                        <a href="{{ route('receives.index') }}" class="nav-link text-white d-flex align-items-center">
                            <i class="fas fa-arrow-down me-2"></i> Receive
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('payments.index') }}" class="nav-link text-white d-flex align-items-center">
                            <i class="fas fa-arrow-up me-2"></i> Payment
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    
        <!-- Add Transaction -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#transactionModal">
                <i class="fas fa-exchange-alt me-2"></i> Add Transaction
            </a>
        </li>
    
        <!-- Tickets -->
        <li class="nav-item">
            <a href="{{ route('tickets.index') }}" class="nav-link text-white d-flex align-items-center">
                <i class="fas fa-ticket-alt me-2"></i> Tickets
            </a>
        </li>
    
        <!-- Contracts -->
        <li class="nav-item">
            <a href="{{ route('contract.index') }}" class="nav-link text-white d-flex align-items-center">
                <i class="fas fa-file-contract me-2"></i> Contracts
            </a>
        </li>
    
        <!-- Reports Dropdown -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#reportMenu">
                <i class="fas fa-chart-line me-2"></i> Reports
            </a>
            <div class="collapse" id="reportMenu">
                <ul class="nav flex-column ms-4">
                    <li class="nav-item">
                        <a href="{{ route('report.statement') }}" class="nav-link text-white d-flex align-items-center">
                            <i class="fas fa-file-alt me-2"></i> Statement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('report.general_ledger') }}" class="nav-link text-white d-flex align-items-center">
                            <i class="fas fa-file-alt me-2"></i> General ledger
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>


    <!-- Agent Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Agent</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <!-- Modal Body -->
              <div class="modal-body">
                  <form id="agent-form" action="{{ route('agents.store') }}" method="POST">
                      @csrf
                      <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                          <!-- Agent Name -->
                          <div>
                              <label for="name" class="block text-sm font-medium text-gray-700">Agent Name</label>
                              <div class="mt-1">
                                  <input id="name" name="name" type="text" autocomplete="given-name" required
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              </div>
                          </div>

                          <!-- Phone Number -->
                          <div>
                              <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                              <div class="mt-1">
                                  <input id="phone" name="phone" type="tel" required
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              </div>
                          </div>

                          <!-- Email -->
                          <div>
                              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                              <div class="mt-1">
                                  <input id="email" name="email" type="email"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              </div>
                          </div>

                          <!-- Address -->
                          <div>
                              <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                              <div class="mt-1">
                                  <input id="address" name="address" type="text" autocomplete="street-address"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              </div>
                          </div>
                      </div>

                      <!-- Buttons -->
                      <div class="mt-6 flex justify-between">
                          <!-- Submit Button -->
                          <button type="submit"
                              class="btn-success text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                              Submit
                          </button>

                          <!-- Cancel Button -->
                          <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500"
                              data-dismiss="modal"> <!-- Add data-dismiss="modal" to close the modal -->
                              Cancel
                          </button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>


  <!--Service Modal -->
  <div class="modal fade" id="servicemodal" tabindex="-1" role="dialog" aria-labelledby="servicemodalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="servicemodalLabel">Add Service</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form id="service-form" action="{{ route('services.store') }}" method="POST">
                      @csrf
                      <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                          <!-- First Name -->
                          <div>
                              <label for="name" class="block text-sm font-medium text-gray-700">Service
                                  Name</label>
                              <div class="mt-1">
                                  <input id="name" name="name" type="text" autocomplete="given-name"
                                      required
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              </div>
                          </div>



                          <!-- Address -->
                          <div>
                              <label for="details" class="block text-sm font-medium text-gray-700">Service
                                  Details</label>
                              <div class="mt-1">
                                  <textarea id="details" name="details" autocomplete="street-details"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                              </div>
                          </div>
                      </div>

                      <!-- Buttons -->
                      <div class="mt-6 flex justify-between">
                          <!-- Submit Button -->
                          <button type="submit"
                              class="btn-success text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                              Submit
                          </button>

                          <!-- Cancel Button -->
                          <button type="button" onclick="document.getElementById('agent-form').reset()"
                              class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                              Cancel
                          </button>
                      </div>
                  </form>

              </div>

          </div>
      </div>
  </div>


  <!--Supplier Modal -->
  <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form id="supplier-form" method="post" action="{{ route('supplier.store') }}">
                      @csrf
                      <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                          <!-- First Name -->
                          <div>
                              <label for="name" class="block text-sm font-medium text-gray-700">Supplier
                                  name</label>
                              <div class="mt-1">
                                  <input id="name" name="name" type="text" autocomplete="given-name"
                                      required
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              </div>
                          </div>

                          <div>
                              <label for="phone" class="block text-sm font-medium text-gray-700">Phone
                                  Number</label>
                              <div class="mt-1">
                                  <input id="phone" name="phone" type="number" required
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              </div>
                          </div>

                          <div>
                              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                              <div class="mt-1">
                                  <input id="email" name="email" type="email"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              </div>
                          </div>

                          <!-- Address -->
                          <div>
                              <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                              <div class="mt-1">
                                  <input id="address" name="address" type="text"
                                      autocomplete="street-address"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                              </div>
                          </div>
                      </div>
                      <!-- Buttons -->
                      <div class="mt-6 flex justify-between">
                          <!-- Submit Button -->
                          <button type="submit"
                              class="btn-success text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                              Submit
                          </button>

                          <!-- Cancel Button -->
                          <button type="button" onclick="document.getElementById('supplier-form').reset()"
                              class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                              Cancel
                          </button>
                      </div>
                  </form>
              </div>

          </div>
      </div>
  </div>



  <!-- Transaction Modal -->
  <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Agent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <div class="modal-body">
                  <form id="transactionForm" action="{{ route('transactions.store') }}" method="POST">
                      @csrf

                      <!-- Transaction Type -->
                      <div class="mb-3">
                          <label for="type" class="form-label">Transaction Type</label>
                          <select name="transaction_type" id="type" class="form-control" required>
                              <option value="">...</option>
                              <option value="bank">Bank</option>
                              <option value="cash">Cash</option>

                          </select>
                      </div>


                      <!-- Bank Fields (Initially Hidden) -->
                      <div id="bankFields" style="display: none;">
                          <!-- Bank Name -->
                          <div class="mb-3">
                              <label for="bank_name" class="form-label">Bank Name</label>
                              <input type="text" name="bank_name" id="bank_name" class="form-control">
                          </div>

                          <!-- Account Number -->
                          <div class="mb-3">
                              <label for="account_number" class="form-label">Account Number</label>
                              <input type="text" name="account_number" id="account_number" class="form-control"
                                  maxlength="12">
                          </div>

                          <!-- Branch Name -->
                          <div class="mb-3">
                              <label for="branch_name" class="form-label">Branch Name</label>
                              <input type="text" name="branch_name" id="branch_name" class="form-control">
                          </div>


                      </div>

                      <!-- Opening Balance -->
                      <div class="mb-3">
                          <label for="opening_balance" class="form-label">Opening Balance</label>
                          <input type="number" name="opening_balance" id="opening_balance" class="form-control"
                              step="0.01">
                      </div>

                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" form="transactionForm" class="btn btn-primary">Save Transaction</button>
              </div>
          </div>
      </div>
  </div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
      let sidebar = document.getElementById("sidebar");
      let mainContent = document.getElementById("main-content");
      let toggleBtn = document.getElementById("sidebarToggle");
  
      toggleBtn.addEventListener("click", function () {
        if (sidebar.classList.contains("collapsed")) {
          // Expand the sidebar
          sidebar.classList.remove("collapsed");
          sidebar.style.width = "250px";
          mainContent.style.marginLeft = "250px";
        } else {
          // Collapse the sidebar
          sidebar.classList.add("collapsed");
          sidebar.style.width = "50px"; // Only show the hamburger icon
          mainContent.style.marginLeft = "50px";
        }
      });
    });
</script>