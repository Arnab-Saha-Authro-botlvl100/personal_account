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
            <div class="container-fluid mt-5 bg-light p-4 rounded shadow">
                <h2 class="text-center text-primary mb-4" style="    background-color: antiquewhite;
    border-radius: 10px;
    padding: 10px;">Service List</h2>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center align-middle"
                            id="service-table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 20%;">Service Name</th>
                                    <th scope="col" style="width: 60%;">Service Details</th>
                                    <th scope="col" style="width: 20%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td class="fw-bold">{{ $service->name }}</td>
                                        <td>{{ $service->details }}</td>
                                        <td>
                                            <!-- Delete Button -->
                                            <button class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $service->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
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


    <!-- DataTables CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">

    <!-- jQuery (Required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            
            $('#service-table').DataTable({
                paging: true, // Enable pagination
                searching: true, // Enable search
                ordering: false, // Disable column sorting
                info: true // Display table information
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.delete-btn', function() {
                var serviceId = $(this).data('id'); // Get the service ID
                var _this = $(this); // Reference to the clicked button
                
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
                        // Send AJAX request to delete the service
                        $.ajax({
                            url: '/services/delete/' + serviceId,  // Adjust the route according to your app
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'  // CSRF token for security
                            },
                            success: function(response) {
                                // Handle success (e.g., show success message)
                                Swal.fire(
                                    'Deleted!',
                                    'The service has been deleted.',
                                    'success'
                                );
                                _this.closest('tr').remove();  // Remove the table row
                            },
                            error: function(xhr, status, error) {
                                // Handle error (e.g., show error message)
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting the service.',
                                    'error'
                                );
                            }
                        });
                    }
                });
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