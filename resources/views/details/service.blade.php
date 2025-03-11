<x-app-layout>
    <style>
        @media (min-width: 769px) {
            #main-content {
                margin-left: 150px;
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



    @include('layouts.links')

    <div class="container-fluid" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" style="width: 100%;">
            <div class="container-fluid mt-5">
                <div class="bg-white p-4 rounded shadow-lg"  style="width: 80%; margin: auto;">
                    {{-- <h4 class="mb-4 text-center text-primary">Service List</h4> --}}
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">Service Details</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center align-middle" id="service-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" style="width: 20%;">Service Name</th>
                                    <th scope="col" style="width: 60%;">Service Details</th>
                                    <th scope="col" style="width: 20%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td class="fw-bold text-dark">{{ $service->name }}</td>
                                        <td class="text-muted">{{ $service->details }}</td>
                                        <td>
                                            <!-- Delete Button -->
                                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $service->id }}">
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

     
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
        <div id="liveToast" class="toast align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
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