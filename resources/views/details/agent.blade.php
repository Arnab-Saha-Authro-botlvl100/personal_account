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
                margin-left: 80px;
                /* Match the collapsed sidebar width */
            }
        }
    </style>
    <!-- Custom Styles -->
    <style>
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

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @include('layouts.links')

    <div class="container-fluid" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" style="width: 100%;">
            <div class="container-fluid mt-5 bg-light p-4 rounded shadow-lg">
               
                <div class="card shadow-lg" style="width: 80%; margin-x:auto">
                    <div class="card-header bg-warning text-dark text-center py-3">
                        <h5 class="mb-0">Agent Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered text-center align-middle" id="agent-table">
                                <thead>
                                    <tr  class="table-warning">
                                        <th scope="col">Agent Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Due</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agents as $agent)
                                    <tr>
                                        <td class="fw-bold">{{ $agent->name }}</td>
                                        <td>{{ $agent->phone }}</td>
                                        <td>{{ $agent->email }}</td>
                                        <td>{{ $agent->address }}</td>
                                        <td>{{ $agent->opening_balance }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAgentModal"
                                                data-id="{{ $agent->id }}" data-name="{{ $agent->name }}" data-phone="{{ $agent->phone }}"
                                                data-email="{{ $agent->email }}" data-address="{{ $agent->address }}">
                                                <i class="fas fa-edit"></i> 
                                            </a>
                                            <!-- WhatsApp Chat -->
                                            <a href="https://wa.me/+88{{ $agent->phone }}" target="_blank" class="btn btn-success btn-sm mx-2">
                                                <i class="fab fa-whatsapp"></i> 
                                            </a>
                                            <!-- Delete Button -->
                                            <a href="#" class="btn btn-danger btn-sm delete-btn" data-id="{{ $agent->id }}">
                                                <i class="fas fa-trash"></i> 
                                            </a>
                                        </td>
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


    <!-- Agent Edit Modal -->
    <div class="modal fade" id="editAgentModal" tabindex="-1" aria-labelledby="editAgentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="editAgentModalLabel">Edit Agent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAgentForm">
                        @csrf
                        <input type="hidden" id="agentId" name="agentId">
                        
                        <!-- Agent Name -->
                        <div class="mb-3">
                            <label for="agentName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="agentName" name="name" required>
                        </div>

                        <!-- Agent Phone -->
                        <div class="mb-3">
                            <label for="agentPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="agentPhone" name="phone" required>
                        </div>

                        <!-- Agent Email -->
                        <div class="mb-3">
                            <label for="agentEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="agentEmail" name="email">
                        </div>

                        <!-- Agent Address -->
                        <div class="mb-3">
                            <label for="agentAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="agentAddress" name="address">
                        </div>

                        <!-- Save Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
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
         const editAgentModal = document.getElementById('editAgentModal');
            editAgentModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const agentId = button.getAttribute('data-id');
                const agentName = button.getAttribute('data-name');
                const agentPhone = button.getAttribute('data-phone');
                const agentEmail = button.getAttribute('data-email');
                const agentAddress = button.getAttribute('data-address');
                
                // Populate the modal's fields
                document.getElementById('agentId').value = agentId;
                document.getElementById('agentName').value = agentName;
                document.getElementById('agentPhone').value = agentPhone;
                document.getElementById('agentEmail').value = agentEmail;
                document.getElementById('agentAddress').value = agentAddress;
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
    <script>
        $('#editAgentForm').on('submit', function (e) {
            e.preventDefault();

            const formData = $(this).serialize();

            $.ajax({
                url: '/agents/update', // Your update URL
                type: 'POST',
                data: formData,
                success: function (response) {
                    // SweetAlert success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Agent Updated',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $('#editAgentModal').modal('hide');
                        location.reload(); // Reload the page or update the row dynamically
                    });
                },
                error: function (error) {
                    // SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error updating agent!',
                        confirmButtonText: 'Try Again'
                    });
                }
            });
        });
        $('.delete-btn').on('click', function (e) {
            e.preventDefault();

            const agentId = $(this).data('id');
            console.log(agentId);
            // SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with deletion
                    $.ajax({
                        url: '/agents/delete/' + agentId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Send CSRF token in headers
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'The agent has been marked as deleted.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload(); // Reload the page to update the list
                            });
                        },
                        error: function (error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was an error deleting the agent!',
                                confirmButtonText: 'Try Again'
                            });
                        }
                    });

                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            
            $('#agent-table').DataTable({
                paging: true, // Enable pagination
                searching: true, // Enable search
                ordering: false, // Disable column sorting
                info: true // Display table information
            });

        });
    </script>
</x-app-layout>