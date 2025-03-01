<x-app-layout>
    @include('layouts.links')
    <div class="container-fluid" id="main-content" style="transition: 0.3s;">
        <div class="mt-4 mx-auto px-2" style="width: 100%;">
            <div class="container" id="initial-div">
                <form id="cashbookForm">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label for="type" class="form-label">Select Type <span class="text-danger">*</span></label>
                            <select class="form-control" id="agent_supplier" name="type" required>
                                <option value="">-- Select Type --</option>
                                <option value="agent">Agent</option>
                                <option value="supplier">Supplier</option>
                            </select>
                        </div>
                        
                        <div class="col-md-5" id="dynamicSelectContainer">
                            <!-- Dynamic select options will be loaded here -->
                        </div>
                    </div>
                    
                    <div class="row g-3 align-items-end mt-2">
                        <div class="col-md-5">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        
                        <div class="col-md-5">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        
                        <div class="col-md-2 text-end">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </form>
                <div id="reportdiv">

                </div>
            </div>
        </div>
    </div>

<!-- jQuery (Ensure jQuery is included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('agent_supplier');
        const dynamicSelectContainer = document.getElementById('dynamicSelectContainer');
    
        // Sample data for agents and suppliers (replace with your compacted data)
        const agents = {!! json_encode($agents) !!}; // Ensure $agents is passed from the backend
        const suppliers = {!! json_encode($suppliers) !!}; // Ensure $suppliers is passed from the backend
    
        console.log(typeSelect);
        console.log('Agents:', agents); // Debugging: Check if agents data is loaded
        console.log('Suppliers:', suppliers); // Debugging: Check if suppliers data is loaded
    
        typeSelect.addEventListener('change', function () {
            const selectedType = typeSelect.value;
            console.log('Selected Type:', selectedType); // Debugging: Check if change event is triggered
    
            // Clear the dynamic select container
            dynamicSelectContainer.innerHTML = '';
    
            if (selectedType === 'agent') {
                // Create a select dropdown for agents
                const agentSelect = document.createElement('select');
                agentSelect.className = 'form-control';
                agentSelect.name = 'agent_id';
                agentSelect.innerHTML = '<option value="">-- Select Agent --</option>';
    
                agents.forEach(agent => {
                    agentSelect.innerHTML += `<option value="${agent.id}">${agent.name}</option>`;
                });
    
                dynamicSelectContainer.appendChild(agentSelect);
            } else if (selectedType === 'supplier') {
                // Create a select dropdown for suppliers
                const supplierSelect = document.createElement('select');
                supplierSelect.className = 'form-control';
                supplierSelect.name = 'supplier_id';
                supplierSelect.innerHTML = '<option value="">-- Select Supplier --</option>';
    
                suppliers.forEach(supplier => {
                    supplierSelect.innerHTML += `<option value="${supplier.id}">${supplier.name}</option>`;
                });
    
                dynamicSelectContainer.appendChild(supplierSelect);
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#cashbookForm").on("submit", function (e) {
        e.preventDefault(); // Prevent default form submission
        $.ajax({
            url: "{{ route('report.receive_payment.report') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                $("#reportdiv").html(response.html);
            },
            error: function (xhr) {
                alert("Something went wrong. Please try again.");
            }
            });
        });

    });
</script>
</x-app-layout>