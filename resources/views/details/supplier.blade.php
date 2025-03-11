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
               
                <div class="card shadow-lg" style="width: 80%; margin-x:auto">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">Supplier Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered text-center align-middle" id="supplier-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Supplier Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Due</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td class="fw-bold">{{ $supplier->name }}</td>
                                        <td>{{ $supplier->phone }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->address }}</td>
                                        <td>{{ $supplier->opening_balance }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSupplierModal"
                                                data-id="{{ $supplier->id }}" data-name="{{ $supplier->name }}" data-phone="{{ $supplier->phone }}"
                                                data-email="{{ $supplier->email }}" data-address="{{ $supplier->address }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <!-- WhatsApp Chat -->
                                            <a href="https://wa.me/+88{{ $supplier->phone }}" target="_blank" class="btn btn-success btn-sm">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <a href="#" class="btn btn-danger btn-sm delete-supplier" data-id="{{ $supplier->id }}">
                                                <i class="fas fa-trash-alt"></i>
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


    
    <!-- Edit Supplier Modal -->
    <div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white fw-bold" id="editSupplierModalLabel">Edit Supplier</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editSupplierForm" method="POST" action="{{ route('suppliers.update') }}">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->
                        <input type="hidden" name="id" id="supplierId">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="supplierName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="supplierPhone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="supplierEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="supplierAddress" name="address">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Supplier</button>
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
    $(document).ready(function() {
            
            $('#supplier-table').DataTable({
                paging: true, // Enable pagination
                searching: true, // Enable search
                ordering: false, // Disable column sorting
                info: true // Display table information
            });

        });
    </script>
    <script>
        $('#editSupplierModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var supplierId = button.data('id');
            var supplierName = button.data('name');
            var supplierPhone = button.data('phone');
            var supplierEmail = button.data('email');
            var supplierAddress = button.data('address');

            // Populate the modal fields with the supplier's data
            var modal = $(this);
            modal.find('#supplierId').val(supplierId);
            modal.find('#supplierName').val(supplierName);
            modal.find('#supplierPhone').val(supplierPhone);
            modal.find('#supplierEmail').val(supplierEmail);
            modal.find('#supplierAddress').val(supplierAddress);
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
         $('#editSupplierForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = $(this).serialize(); // Serialize the form data

            $.ajax({
            url: '{{ route("suppliers.update") }}', // Your update route
            type: 'PUT', // Use PUT method for updating
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: 'The supplier has been updated successfully.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    $('#editSupplierModal').modal('hide'); // Hide the modal
                    location.reload(); // Reload the page to see the updated data
                });
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error updating the supplier!',
                    confirmButtonText: 'Try Again'
                });
                }
            });

        });

        $(document).on('click', '.delete-supplier', function (e) {
            e.preventDefault();

            var supplierId = $(this).data('id'); // Get the supplier ID from the button
            var deleteUrl = '/suppliers/delete/' + supplierId; // URL to send the delete request

            // Confirm deletion using SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action will mark the supplier as deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete the supplier
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // CSRF token for security
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'The supplier has been marked as deleted.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload(); // Reload the page to see the updated list
                            });
                        },
                        error: function (error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was an error deleting the supplier!',
                                confirmButtonText: 'Try Again'
                            });
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>