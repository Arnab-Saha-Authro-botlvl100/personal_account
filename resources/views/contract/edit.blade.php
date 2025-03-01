<x-app-layout>

    <div class="container-fluid">
        <h2><span class="badge text-bg-secondary">Edit Contract for {{$customer->first_name}}</span></h2>
    </div>


    <div class="container mt-4">
        <form 
            action="{{ route('contract.update', $contract->id) }}"
            method="POST">
            @csrf
            @method('PUT')

           
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="invoice_no">Invoice No</label>
                        <input type="text" name="invoice_no" id="invoice_no" class="form-control" value="{{ $contract->invoice_no }}" required readonly>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="customer_id" id="customer_id" class="form-control" value="{{ $customer->id }}" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="contract_name">Contract Name</label>
                        <input type="text" name="contract_name" id="contract_name" class="form-control" value="{{ $contract->contract_name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ $contract->date }}" required>
                    </div>

                    <div class="form-group">
                        <label for="agent">Agent</label>
                        <select name="agent" id="agent" class="form-control" required>
                            <option value="">Select Agent</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ $contract->agent == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="agent_price">Agent Price</label>
                        <input type="number" name="agent_price" id="agent_price" class="form-control" value="{{ $contract->agent_price }}" required>
                    </div>

                </div>
                <div class="col-md-6">

                   
                    <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <select name="supplier" id="supplier" class="form-control" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ $contract->supplier == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="supplier_price">Supplier Price</label>
                        <input type="number" name="supplier_price" id="supplier_price" class="form-control" value="{{ $contract->supplier_price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="contract_details">Contract Details</label>
                        <textarea name="contract_details" id="contract_details" class="form-control">{{ $contract->contract_details }}</textarea>
                    </div>

                </div>
            </div>
            <!-- Other fields like agent, supplier, etc. -->

            <button type="submit" class="btn btn-primary mt-3">Update Contract</button>
        </form>
    </div>
</x-app-layout>