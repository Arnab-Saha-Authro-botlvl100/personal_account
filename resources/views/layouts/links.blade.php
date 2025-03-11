{{-- backup --}}
{{-- <style>
    /* Prevent horizontal scrolling */
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    /* Sidebar for larger screens */
    .sidebar {
        width: 250px; /* Expanded width */
        height: 100vh;
        position: fixed;
        top: 50px;
        left: 0;
        background: #6c859e;
        color: white;
        padding: 15px;
        overflow-y: auto;
        transition: width 0.3s ease-in-out; /* Smooth transition */
        z-index: 30000;
    }

    /* Collapsed sidebar styles */
    .sidebar.collapsed {
        width: 50px; /* Width when collapsed */
    }

    /* Sidebar Header Flex Layout */
    .sidebar-header {
        display: flex !important;
        flex-direction: row !important; /* Default: horizontal alignment */
        justify-content: space-between; /* Space between icons */
        align-items: center; /* Vertically center icons */
        width: 100%;
    }

    /* When collapsed class is present, change flex-direction to column */
    .collapsed .sidebar-header {
        flex-direction: column !important; /* Vertical alignment */
        justify-content: center; /* Center icons vertically */
        gap: 10px; /* Add space between icons */
    }

    /* Space from top for notification icon */
    .sidebar-header .notification-icon {
        margin-top: 20px; /* Add space from the top */
    }

    /* Styling for nav links */
    .nav-link {
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
        color: #ffffff;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Hover effect for nav links */
    .nav-link:hover {
        background-color: #495057;
        color: #fff !important;
    }

    /* Active state for nav links */
    .nav-link.active {
        background-color: #0d6efd;
        color: #fff !important;
    }

    /* Dropdown toggle arrow alignment */
    .dropdown-toggle::after {
        margin-left: auto;
    }

    /* Styling for dropdown menus */
    .collapse ul {
        margin-left: 20px;
        list-style: none;
        padding-left: 0;
    }

    /* Styling for dropdown items */
    .collapse ul .nav-link {
        padding: 8px 15px;
        background-color: transparent;
        border-radius: 4px;
    }

    /* Hover effect for dropdown items */
    .collapse ul .nav-link:hover {
        background-color: #343a40;
    }

    /* Active state for dropdown items */
    .collapse ul .nav-link.active {
        background-color: #0d6efd;
    }

    /* Optional: Add a border to separate dropdown items */
    .collapse ul .nav-link {
        border-bottom: 1px solid #444;
    }

    /* Remove border from the last dropdown item */
    .collapse ul .nav-link:last-child {
        border-bottom: none;
    }

    /* Optional: Add a transition effect for dropdown items */
    .collapse ul .nav-link {
        transition: background-color 0.2s, color 0.2s;
    }

    /* Notification icon styling */
    .notification-icon {
        position: relative;
    }

    /* Notification badge styling */
    .notification-badge {
        top: -13px; /* Adjust this value to move the badge closer to the icon */
        left: 3px; /* Adjust this value for horizontal positioning */
        font-size: 0.75rem; /* Adjust the font size of the badge */
        padding: 0.25rem 0.5rem; /* Adjust padding if needed */
    }
</style> --}}

<style>
    /* Prevent horizontal scrolling */
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        background: linear-gradient(145deg, #6c859e, #5a7185);
        color: white;
        padding: 15px;
        overflow-y: auto; /* Ensure scrolling */
        overflow-x: hidden; /* Prevent horizontal scroll */
        transition: width 0.3s ease-in-out;
        z-index: 30000;
        box-shadow: 3px 0 10px rgba(0, 0, 0, 0.2);
        border-radius: 0 15px 15px 0;
        margin-bottom: 10px;
    }


    /* Add hover effect for a modern touch */
    .sidebar:hover {
        box-shadow: 5px 0 15px rgba(0, 0, 0, 0.3); /* Enhanced shadow on hover */
    }

    /* Style for the sidebar header */
    .sidebar-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background: rgba(255, 255, 255, 0.1); 
        border-radius: 10px; /* Rounded corners */
        margin-bottom: 15px; /* Add space below the header */
    }

    /* Style for the notification icon */
    .notification-icon {
        position: relative;
        background: rgba(255, 255, 255, 0.1); 
        transition: background 0.3s ease;
    }

    .notification-icon:hover {
        background: rgba(255, 255, 255, 0.2); /* Lighten background on hover */
    }

    /* Style for the notification badge */
    .notification-badge {
        top: -10px;
        right: -10px;
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        background: #ff4757; /* Red color for badge */
        border: 2px solid #6c859e; /* Match sidebar background */
        border-radius: 50%; /* Circular badge */
    }

    .nav-link {
        padding: 10px 15px;
        border-radius: 8px; /* Rounded corners */
        transition: background-color 0.3s, color 0.3s;
        color: white;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 5px 0; /* Add space between links */
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.1); /* Light background on hover */
        color: white !important;
    }

    .nav-link.active {
        background: #0d6efd; /* Active link background */
        color: white !important;
    }

    .collapsed .sidebar {
        width: 80px; /* Collapsed width */
    }

    .collapsed .sidebar-header {
        flex-direction: column; /* Change to vertical layout */
    }
    .collapsed .nav-link {
        justify-content: center; /* Center icons in collapsed state */
    }

    .collapsed .notification-icon{
        margin-top: 20px; 
    }
    /* Style for dropdown menus */
    .collapsed ul {
        margin-left: 60px;
        list-style: none;
        padding-left: 0;
    }

    .collapsed ul .nav-link {
        padding: 8px 15px;
        background-color: transparent;
        border-radius: 4px;
    }

    .collapsed ul .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1); /* Light background on hover */
    }

    .collapsed ul .nav-link.active {
        background-color: #0d6efd; /* Active link background */
    }

    /* Add a subtle border to separate dropdown items */
    .collapsed ul .nav-link {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Light border */
    }

    /* Remove border from the last dropdown item */
    .collapsed ul .nav-link:last-child {
        border-bottom: none;
    }

    /* Optional: Add a transition effect for dropdown items */
    .collapsed ul .nav-link {
        transition: background-color 0.2s, color 0.2s;
    }

    /* Optional: Add animation to the sidebar */
    @keyframes slideIn {
        from {
            transform: translateX(-100%);
        }
        to {
            transform: translateX(0);
        }
    }

    .sidebar {
        animation: slideIn 0.5s ease-out; /* Slide-in animation */
    }

        /* Custom Navbar Styles */
    .navbar {
        background: linear-gradient(90deg, #575767, #c0580e);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        padding: 10px 20px; /* Add padding for better spacing */
        display: flex;
        justify-content: space-between; /* Space out navbar items */
        align-items:center; /* Vertically center items */
        position: sticky; /* Make navbar sticky */
        top: 0;
        z-index: 1000; /* Ensure navbar stays on top */
    }

    .navbar-collapse {
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.3s ease-out;
    }

    .navbar-collapse.show {
        max-height: 800px; /* Adjust this value based on your content */
        overflow-y: scroll; 
    }

    .navbar-toggler {
        border: none; /* Remove default border */
    }

    .navbar-toggler-icon {
        color: white; /* Ensure the icon is visible */
    }

    .nav-link {
        color: white !important;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #f1f2f6 !important; /* Light gray on hover */
    }
    /* Dropdown Menu Container */
    .navbar .dropdown-menu {
        background: linear-gradient(90deg, #575767, #c0580e);
        border: none; /* Remove default border */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        padding: 0.5rem 0; /* Add padding */
        margin-top: 0.5rem; /* Space between toggle and menu */
        display: none; /* Hide by default */
        opacity: 0; /* Start with 0 opacity for transition */
        transition: opacity 0.3s ease, transform 0.3s ease; /* Smooth transition */
        transform: translateY(-10px); /* Slight upward shift for animation */
        position: absolute; /* Position dropdown absolutely */
        z-index: 1000; /* Ensure dropdown appears above other content */
        min-width: 200px; /* Set a minimum width */
    }

    #sidebar .custom-dropdown-menu {
        display: none; /* Hide dropdown by default */
    }

    #sidebar .custom-dropdown-menu.show {
        display: block; /* Show dropdown when 'show' class is added */
    }
    /* Show Dropdown Menu */
    .navbar .dropdown-menu.show {
        display: block; /* Show the dropdown */
        opacity: 1; /* Fully visible */
        transform: translateY(0); /* Reset position */
    }

    /* Dropdown Items */
    .navbar .dropdown-item {
        color: white !important; /* White text for dropdown items */
        padding: 0.5rem 1rem; /* Add padding */
        text-decoration: none; /* Remove underline */
        display: block; /* Make items block-level */
        transition: background-color 0.3s ease; /* Smooth hover effect */
    }

    /* Hover Effect for Dropdown Items */
    .navbar .dropdown-menu li:hover {
        background-color: #e8414d; /* Slightly darker on hover */
    }

    /* Dropdown Icons */
    .navbar .dropdown-item i {
        margin-right: 0.5rem; /* Space between icon and text */
    }

    .notification-badge {
        font-size: 0.75rem; /* Smaller badge text */
        padding: 0.25em 0.5em; /* Adjust padding */
    }

    .navbar .collapse{
        display: none;
    }
    .navbar .show{
        display: block;
    }

</style>
<style>
    /* Hide sidebar on mobile */
    @media (max-width: 850px) {
        .sidebar {
            display: none !important;
        }
        #navbar {
            display: flex !important;
        }
        #main-content{
            margin-left: 0;
        }
    }

    /* Sidebar collapsed for 851px - 1600px */
    @media (min-width: 851px) and (max-width: 1600px) {
        #navbar {
            display: none !important;
        }
    }

    /* Sidebar expanded for > 1600px */
    @media (min-width: 1601px) {
        .sidebar {
            width: 250px;
        }
        #navbar {
            display: none !important;
        }
    }

</style>

@php
    use App\Models\Agent; // Make sure to import your Customer model
    use App\Models\Supplier; // Make sure to import your Customer model
    $agents = Agent::where('is_active', 1)
            ->where('user', Auth::id())
            ->where('is_delete', 0)
            ->get();

        // Fetch suppliers
    $suppliers = Supplier::where('is_active', 1)
            ->where('user', Auth::id())
            ->where('is_delete', 0)
            ->get();
@endphp

<!-- Sidebar / Navbar -->

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="#" class="text-white text-decoration-none" id="sidebarToggle">
            <i class="fas fa-bars" style="cursor: pointer;"></i>
        </a>
        <div class="notification-icon position-relative">
            <a href="#" class="text-white" id="notificationButton">
                <i class="fas fa-bell fa-lg"></i>
            </a>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge text-white fw-bold">
                {{$notificationCount}}
            </span>
        </div>
    </div>

    <ul class="nav nav-pills flex-column mb-auto" id="sidebar-list">
        <!-- Add Service -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#servicemodal">
                <i class="fas fa-tools me-2"></i> Add Service
            </a>
        </li>

        <!-- Add Agent -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                <i class="fas fa-user-tie me-2"></i> Add Agent
            </a>
        </li>

        <!-- Add Supplier -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#supplierModal">
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
            <a href="#" class="nav-link text-white d-flex align-items-center dropdown-toggle custom-dropdown-toggle"
                id="paymentMenuToggle">
                <i class="fas fa-wallet me-2"></i> Receive/Payment
            </a>
            <div class="custom-dropdown-menu" id="paymentMenu">
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
            <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#transactionModal">
                <i class="fas fa-exchange-alt me-2"></i> Add Transaction
            </a>
        </li>

        <!-- Notes -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#notesModal">
                <i class="fas fa-sticky-note me-2"></i> Add Note
            </a>
        </li>

        <!-- Previous Due -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#previousDueModal">
                <i class="fas fa-money-bill-wave me-2"></i> Previous Due
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
            <a href="#" class="nav-link text-white d-flex align-items-center dropdown-toggle"
                data-bs-toggle="collapse" data-bs-target="#reportMenu">
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
                        <a href="{{ route('report.general_ledger') }} "
                            class="nav-link text-white d-flex align-items-center">
                            <i class="fas fa-file-alt me-2"></i> General ledger
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('report.cashbook') }} "
                            class="nav-link text-white d-flex align-items-center">
                            <i class="fas fa-file-alt me-2"></i> Cash Book
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('report.receive_payment') }} "
                            class="nav-link text-white d-flex align-items-center">
                            <i class="fas fa-file-alt me-2"></i> Receive Payment
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Reports Dropdown -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white d-flex align-items-center dropdown-toggle"
                data-bs-toggle="collapse" data-bs-target="#detailsMenu">
                <i class="fa-solid fa-circle-info"></i> Details
            </a>
            <div class="collapse" id="detailsMenu">
                <ul class="nav flex-column ms-4">
                    <!-- Agent -->
                    <li class="nav-item">
                        <a href="{{ route('details.agent') }}" class="nav-link text-white d-flex align-items-center">
                            <i class="fas fa-user-tie me-2"></i> <!-- Icon for Agent -->
                            <span>Agent</span>
                        </a>
                    </li>
                
                    <!-- Supplier -->
                    <li class="nav-item">
                        <a href="{{ route('details.supplier') }}" class="nav-link text-white d-flex align-items-center">
                            <i class="fas fa-truck me-2"></i> <!-- Icon for Supplier -->
                            <span>Supplier</span>
                        </a>
                    </li>
                
                    <!-- Transactions -->
                    <li class="nav-item">
                        <a href="{{ route('details.transactions') }}" class="nav-link text-white d-flex align-items-center">
                            <i class="fas fa-exchange-alt me-2"></i> <!-- Icon for Transactions -->
                            <span>Transactions</span>
                        </a>
                    </li>
                
                    <!-- Services -->
                    <li class="nav-item">
                        <a href="{{ route('details.services') }}" class="nav-link text-white d-flex align-items-center">
                            <i class="fas fa-tools me-2"></i> <!-- Icon for Services -->
                            <span>Services</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<!-- Navbar for mobile screens (850px and below) -->
<nav class="navbar navbar-expand-lg navbar-light d-lg-none mx-auto" id="navbar" style="width: 90%">
    <div class="container-fluid">
        <!-- Notification Icon -->
        <div class="notification-icon position-relative">
            <a href="#" class="text-white" id="navbarNotificationButton" aria-label="Notifications">
                <i class="fa-solid fa-bell"></i>
            </a>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge text-white fw-bold">
                {{$notificationCount}}
            </span>
        </div>
        
        <!-- Toggle Button -->
        <button class="navbar-toggler" id="customNavbarToggler" type="button" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon fw-bold">
                <i class="fa-solid fa-sliders text-white"></i>
            </span>
        </button>

        <!-- Collapsible Menu -->
        <div class="collapse navbar-collapse" id="mobileNavbar">
            <!-- Add your navbar items here -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Add Service -->
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#servicemodal">
                        <i class="fas fa-tools me-2"></i> Add Service
                    </a>
                </li>
                
                <!-- Add Agent -->
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-user-tie me-2"></i> Add Agent
                    </a>
                </li>
                
                <!-- Add Supplier -->
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#supplierModal">
                        <i class="fas fa-truck me-2"></i> Add Supplier
                    </a>
                </li>
                
                
                <!-- Add Customer -->
                <li class="nav-item">
                    <a href="{{ route('customers.create') }}" class="nav-link">
                        <i class="fas fa-user-plus me-2"></i> Add Customer
                    </a>
                </li>

                <!-- Payments Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="paymentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-wallet me-2"></i> Receive/Payment
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="paymentDropdown">
                        <li><a class="dropdown-item" href="{{ route('receives.index') }}"><i class="fas fa-arrow-down me-2"></i> Receive</a></li>
                        <li><a class="dropdown-item" href="{{ route('payments.index') }}"><i class="fas fa-arrow-up me-2"></i> Payment</a></li>
                    </ul>
                </li>


                  <!-- Add Transaction -->
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#transactionModal">
                        <i class="fas fa-exchange-alt me-2"></i> Add Transaction
                    </a>
                </li>

                <!-- Notes -->
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#notesModal">
                        <i class="fas fa-sticky-note me-2"></i> Add Note
                    </a>
                </li>

                <!-- Previous Due -->
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#previousDueModal">
                        <i class="fas fa-money-bill-wave me-2"></i> Previous Due
                    </a>
                </li>

                <!-- Tickets -->
                <li class="nav-item">
                    <a href="{{ route('tickets.index') }}" class="nav-link">
                        <i class="fas fa-ticket-alt me-2"></i> Tickets
                    </a>
                </li>

                <!-- Contracts -->
                <li class="nav-item">
                    <a href="{{ route('contract.index') }}" class="nav-link">
                        <i class="fas fa-file-contract me-2"></i> Contracts
                    </a>
                </li>

                
                <!-- Reports Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-chart-line me-2"></i> Reports
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="reportsDropdown">
                        <li><a class="dropdown-item" href="{{ route('report.statement') }}"><i class="fas fa-file-alt me-2"></i> Statement</a></li>
                        <li><a class="dropdown-item" href="{{ route('report.general_ledger') }}"><i class="fas fa-file-alt me-2"></i> General Ledger</a></li>
                        <li><a class="dropdown-item" href="{{ route('report.cashbook') }}"><i class="fas fa-file-alt me-2"></i> Cash Book</a></li>
                        <li><a class="dropdown-item" href="{{ route('report.receive_payment') }}"><i class="fas fa-file-alt me-2"></i> Receive Payment Report</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content shadow-lg rounded-3">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="notificationModalLabel">Notifications</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4 py-3">
                <!-- Notifications List -->
                <div id="notificationList">
                    <!-- Example notification item -->
                    <div class="notification-item p-3 mb-3 border rounded-3">
                        <h6 class="fw-semibold">Sample Notification Title</h6>
                        <p class="text-muted mb-1">This is the description of the notification. It can be longer depending on the content.</p>
                        <small class="text-muted">Just now</small>
                    </div>

                    <!-- Another Example notification item -->
                    <div class="notification-item p-3 mb-3 border rounded-3">
                        <h6 class="fw-semibold">Another Notification</h6>
                        <p class="text-muted mb-1">Here’s another notification example, with some different content for variety.</p>
                        <small class="text-muted">5 minutes ago</small>
                    </div>

                    <!-- Loading placeholder -->
                    <p class="text-center text-muted" id="loadingText">Loading notifications...</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Note Modal -->
<div class="modal fade" id="notesModal" tabindex="-1" aria-labelledby="notesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg rounded-3">
            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="notesModalLabel">Add New Note</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4 py-3">
                <form id="notesForm" method="POST" action="{{ route('notes.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="noteTitle" class="form-label fw-semibold">Title</label>
                        <input type="text" class="form-control" id="noteTitle" name="title" required placeholder="Enter note title">
                    </div>

                    <div class="mb-3">
                        <label for="noteDate" class="form-label fw-semibold">Date</label>
                        <input type="date" class="form-control" id="noteDate" name="date" required>
                    </div>

                    <div class="mb-3">
                        <label for="noteDescription" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" id="noteDescription" name="description" rows="3" required placeholder="Enter the note description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="noteStatus" class="form-label fw-semibold">Status</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                            <select class="form-select" id="noteStatus" name="status" style="width: 93%">
                                <option value="pending" selected>Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                     <!-- Modal Footer (Close Button) -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Note</button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Close
                        </button>
                    </div>
                </form>
            </div>

           
        </div>
    </div>
</div>


<!-- Agent Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header with custom background -->
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Add Agent</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="agent-form" action="{{ route('agents.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Agent Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Agent Name</label>
                            <div class="mt-1">
                                <input id="name" name="name" type="text" autocomplete="given-name" required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-info-500 focus:border-info-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <div class="mt-1">
                                <input id="phone" name="phone" type="tel" required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-info-500 focus:border-info-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-info-500 focus:border-info-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <div class="mt-1">
                                <input id="address" name="address" type="text" autocomplete="street-address"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-info-500 focus:border-info-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex justify-between">
                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn-success text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-info-500">
                            Submit
                        </button>

                        <!-- Cancel Button -->
                        <button type="button"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Service Modal -->
<div class="modal fade" id="servicemodal" tabindex="-1" role="dialog" aria-labelledby="servicemodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg rounded-3">
            <!-- Modal Header with custom background -->
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold" id="servicemodalLabel">Add Service</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4 py-3">
                <form id="service-form" action="{{ route('services.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Service Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Service Name</label>
                            <div class="mt-1">
                                <input id="name" name="name" type="text" autocomplete="given-name" required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Service Details -->
                        <div>
                            <label for="details" class="block text-sm font-medium text-gray-700">Service Details</label>
                            <div class="mt-1">
                                <textarea id="details" name="details" autocomplete="street-details"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-success-500 focus:border-success-500 sm:text-sm"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex justify-between">
                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn-success text-white px-4 py-2 rounded-md hover:bg-success-600 focus:outline-none focus:ring-2 focus:ring-success-500">
                            Submit
                        </button>

                        <!-- Cancel Button -->
                        <button type="button" onclick="document.getElementById('service-form').reset()"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Supplier Modal -->
<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content shadow-lg rounded-3">
            <!-- Modal Header with custom background -->
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Add Supplier</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4 py-3">
                <form id="supplier-form" method="post" action="{{ route('supplier.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Supplier Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Supplier Name</label>
                            <div class="mt-1">
                                <input id="name" name="name" type="text" autocomplete="given-name" required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-info-500 focus:border-info-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <div class="mt-1">
                                <input id="phone" name="phone" type="number" required
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-info-500 focus:border-info-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-info-500 focus:border-info-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <div class="mt-1">
                                <input id="address" name="address" type="text" autocomplete="street-address"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-info-500 focus:border-info-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex justify-between">
                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn-info text-white px-4 py-2 rounded-md hover:bg-info-600 focus:outline-none focus:ring-2 focus:ring-info-500">
                            Submit
                        </button>

                        <!-- Cancel Button -->
                        <button type="button" onclick="document.getElementById('supplier-form').reset()"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500" data-bs-dismiss="modal">
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
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-lg">
            {{-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">Add Transaction</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-3">
                <form id="transactionForm" action="{{ route('transactions.store') }}" method="POST">
                    @csrf

                    <!-- Transaction Type -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Transaction Type</label>
                        <select name="transaction_type" id="type" class="form-control" required>
                            <option value="">Select Transaction Type...</option>
                            <option value="bank">Bank</option>
                            <option value="cash">Cash</option>

                        </select>
                    </div>


                    <!-- Bank Fields (Initially Hidden) -->
                    <div id="bankFields" style="display: none;" class="border p-3 rounded bg-light">
                        <h6 class="text-primary mb-3">Bank Details</h6>

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
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="transactionForm" class="btn btn-primary">Save Transaction</button>
            </div>
        </div>
    </div>
</div>


<!-- Previous Due Modal -->
<div class="modal fade" id="previousDueModal" tabindex="-1" aria-labelledby="previousDueModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg rounded-3">
            <!-- Modal Header with custom background -->
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title fw-bold" id="previousDueModalLabel">Add Previous Due</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4 py-3">
                <form id="previousDueForm">
                    @csrf
                    <!-- Select Type -->
                    <div class="mb-3">
                        <label for="typeSelect" class="form-label">Select Type</label>
                        <select class="form-control form-select" id="typeSelect" name="type">
                            <option value="">-- Select Type --</option>
                            <option value="agent">Agent</option>
                            <option value="supplier">Supplier</option>
                        </select>
                    </div>

                    <!-- Agent Select Dropdown (Initially hidden) -->
                    <div class="mb-3" id="agentSelectDiv" style="display: none;">
                        <label for="agentSelect" class="form-label">Select Agent</label>
                        <select class="form-control form-select" id="agentSelect" name="agent_id">
                            <option value="">-- Select Agent --</option>
                            @foreach ($agents as $agent)
                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Supplier Select Dropdown (Initially hidden) -->
                    <div class="mb-3" id="supplierSelectDiv" style="display: none;">
                        <label for="supplierSelect" class="form-label">Select Supplier</label>
                        <select class="form-control form-select" id="supplierSelect" name="supplier_id">
                            <option value="">-- Select Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Amount Field -->
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount">
                    </div>

                    <!-- Note Field -->
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note" rows="3" placeholder="Enter a note"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <!-- Save Button -->
                        <button type="submit" class="btn btn-warning text-white px-4 py-2 rounded-md hover:bg-warning-600 focus:outline-none focus:ring-2 focus:ring-warning-500">
                            Save
                        </button>

                        <!-- Cancel Button -->
                        <button type="button" onclick="document.getElementById('previousDueForm').reset()"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("sidebarToggle");
        const sidebar = document.getElementById("sidebar");

        // Function to check screen size and toggle sidebar visibility
        function checkScreenSize() {
            if (window.innerWidth <= 850) {
                sidebar.style.display = 'none'; // Hide sidebar on mobile
                document.body.classList.remove("collapsed"); // Ensure sidebar is not collapsed
            } else {
                sidebar.style.display = 'block'; // Show sidebar on larger screens
                // Collapse sidebar by default for screens 1600px or less
                if (window.innerWidth <= 1600 && window.innerWidth > 850) {
                    document.body.classList.add("collapsed");
                } else {
                    document.body.classList.remove("collapsed");
                }
            }
        }

        // Initial check on page load
        checkScreenSize();

        // Toggle sidebar collapse/expand
        toggleBtn.addEventListener("click", function () {
            document.body.classList.toggle("collapsed");
        });

        // Handle window resize to update the sidebar visibility dynamically
        window.addEventListener("resize", checkScreenSize);
    });

    document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("customNavbarToggler");
    const navbarCollapse = document.getElementById("mobileNavbar");

    toggleButton.addEventListener("click", function () {
        if (navbarCollapse.classList.contains('show')) {
            // console.log('Collapsing navbar'); // Debugging
            navbarCollapse.classList.remove('show'); // Remove the 'show' class
            navbarCollapse.classList.add('collapse'); // Add the 'collapse' class
        } else {
            // console.log('Expanding navbar'); // Debugging
            navbarCollapse.classList.remove('collapse'); // Remove the 'collapse' class
            navbarCollapse.classList.add('show'); // Add the 'show' class
        }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Get the toggle button and dropdown menu
    const paymentMenuToggle = document.getElementById('paymentMenuToggle');
    const paymentMenu = document.getElementById('paymentMenu');

    // Add click event listener to the toggle button
    paymentMenuToggle.addEventListener('click', function (e) {
        // console.log('Toggle clicked'); // Debugging
        e.preventDefault(); // Prevent default link behavior

        // Check if the 'show' class is present
        if (paymentMenu.classList.contains('show')) {
            // console.log('Removing "show" class'); // Debugging
            paymentMenu.classList.remove('show'); // Remove the 'show' class
        } else {
            // console.log('Adding "show" class'); // Debugging
            paymentMenu.classList.add('show'); // Add the 'show' class
        }

        // Log the current state of the dropdown menu
        // console.log('Dropdown menu visibility:', paymentMenu.style.display); // Debugging
    });
});
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#bankFields').hide();
        $('#type').change(function() {
            if ($(this).val() === 'bank') {
                $('#bankFields').show();
            } else {
                $('#bankFields').hide();
            }
        });
        function fetchNotifications() {
            $.ajax({
                url: "{{ route('notifications.fetch') }}",
                type: "GET",
                dataType: "json",
                beforeSend: function() {
                    $("#notificationList").html('<p class="text-center text-muted">Loading...</p>');
                },
                success: function(response) {
                    let notificationList = $("#notificationList");
                    notificationList.empty(); // Clear previous content

                    if (response.notifications.length > 0) {
                        let table = `
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;

                        $.each(response.notifications, function(index, notification) {
                            let notificationDate = new Date(notification.date);
                            let formattedDate = (notificationDate.getDate()).toString().padStart(2, '0') + '-' + 
                                (notificationDate.getMonth() + 1).toString().padStart(2, '0') + '-' + 
                                notificationDate.getFullYear();
                            table += `
                                <tr>
                                    <td>${notification.title}</td>
                                    <td>${formattedDate}</td>
                                    <td>
                                        <textarea class="form-control description-field" data-id="${notification.id}">${notification.description}</textarea>
                                    </td>
                                    <td>
                                        <select class="form-select notification-status" data-id="${notification.id}">
                                            <option value="pending" ${notification.status === 'pending' ? 'selected' : ''}>Pending</option>
                                            <option value="completed" ${notification.status === 'completed' ? 'selected' : ''}>Completed</option>
                                        </select>
                                    </td>
                                </tr>
                            `;
                        });

                        table += `</tbody></table>`;
                        notificationList.html(table);
                    } else {
                        notificationList.html('<p class="text-center text-muted">No new notifications.</p>');
                    }

                    // Reset the notification badge count
                    // $(".notification-badge").text("0");
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching notifications:", error);
                }
            });
        }

        // Sidebar notification button
        $("#notificationButton").on("click", function() {
            fetchNotifications(); // Call AJAX function
            $("#notificationModal").modal("show"); // Show the modal
        });

        // Navbar notification button
        $("#navbarNotificationButton").on("click", function() {
            fetchNotifications(); // Call AJAX function
            $("#notificationModal").modal("show"); // Show the modal
        });

        // Update notification status
        $(document).on("change", ".notification-status", function() {
            let noteId = $(this).data("id");
            let newStatus = $(this).val();
            let selectElement = $(this); // Store reference to the select dropdown

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to update the status?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, update it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('notifications.update') }}", 
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: noteId,
                            status: newStatus
                        },
                        success: function(response) {
                            Swal.fire("Updated!", "The status has been updated.", "success");
                        },
                        error: function(xhr, status, error) {
                            Swal.fire("Error!", "Something went wrong.", "error");
                            // Reset the dropdown to previous value on error
                            selectElement.val(selectElement.data("previous"));
                        }
                    });
                } else {
                    // Reset the dropdown if the user cancels
                    selectElement.val(selectElement.data("previous"));
                }
            });
        });

        // Store the previous value before the user changes the status
        $(document).on("focus", ".notification-status", function() {
            $(this).data("previous", $(this).val());
        });

        // Update notification description
        $(document).on("change", ".description-field", function() {
            let noteId = $(this).data("id");
            let newDescription = $(this).val();
            let textareaElement = $(this); // Store reference to the textarea element

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to update the description?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, update it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('notifications.updateDescription') }}", // Define the route in your Laravel web.php
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: noteId,
                            description: newDescription
                        },
                        success: function(response) {
                            Swal.fire("Updated!", "The description has been updated.", "success");
                        },
                        error: function(xhr, status, error) {
                            Swal.fire("Error!", "Something went wrong while updating the description.", "error");
                            // Reset the textarea value on error
                            textareaElement.val(textareaElement.data("previous"));
                        }
                    });
                } else {
                    // Reset the textarea if the user cancels
                    textareaElement.val(textareaElement.data("previous"));
                }
            });
        });

        // Store the previous value before the user changes the description
        $(document).on("focus", ".description-field", function() {
            $(this).data("previous", $(this).val());
        });

        $('#typeSelect').on('change', function () {
            let selectedType = $(this).val();

            if (selectedType === 'agent') {
                $('#agentSelectDiv').show();
                $('#supplierSelectDiv').hide();
                $('#supplierSelect').val(''); // Reset supplier selection
            } else if (selectedType === 'supplier') {
                $('#supplierSelectDiv').show();
                $('#agentSelectDiv').hide();
                $('#agentSelect').val(''); // Reset agent selection
            } else {
                $('#agentSelectDiv').hide();
                $('#supplierSelectDiv').hide();
                $('#agentSelect').val('');
                $('#supplierSelect').val('');
            }
        });

        $('#previousDueForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/previous-due/store',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Previous due added successfully!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to add previous due!',
                        confirmButtonText: 'Try Again'
                    });
                }
            });
        });

    });
</script>

