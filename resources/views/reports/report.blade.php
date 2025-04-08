<div class="container-fluid shadow-lg p-5 mt-4">
    <h2 class="text-center font-weight-bold text-xl my-4 text-dark">General Ledger</h2>
            
<!-- Company Information -->
<div class="d-flex justify-content-between mb-4">
    <div class="text-lg">
        <h3 class="font-semibold text-dark">Company Name: {{ Auth::user()->name }}</h3>
        <p><span class="font-semibold">Period Date:</span> {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} to {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</p>
    </div>
    <div class="text-lg text-right">
        <h3 class="font-semibold text-dark">Email: {{ Auth::user()->email }}<br>Phone: {{ Auth::user()->phone }}</h3>
        <p><span class="font-semibold">Address:</span> {{ Auth::user()->address }}</p>
    </div>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-dark text-center">
        <tr>
            <th>Date</th>
            {{-- <th>Invoice/Customer ID/Type</th> --}}
            <th>Details</th>
            <th>Receive Amount</th>
            <th>Payment Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sorted as $item)
        @if ($item->getTable() == 'customers')
            <tr class="table-customer bg-info-subtle">
                <td>
                    {{ $item->created_at->format('d-m-y') }}
                </td>
                <td>{{ $item->customer_id }}</td>
                <td>
                    <strong>{{ $item->name }}</strong><br>
                     {{ $item->phone_number }}<br>
                     {{ $item->passport_number }}
                </td>
                <td><strong class="text-success">{{ $item->agent_contract }}</strong></td>
                <td><strong class="text-danger">{{ $item->supplier_contract }}</strong></td>
            </tr>
        @elseif($item->getTable() == 'receives')
            <tr class="table-receive bg-success-subtle">
                <td>
                    {{-- <span
                        class="badge bg-success text-white text-uppercase fw-bold">Receive</span><br> --}}
                    {{ $item->created_at->format('d-m-y') }}
                </td>
                {{-- <td>{{ $item->receive_type }}</td> --}}
                <td>
                    @if ($item->receive_type == 'customer')
                        <strong>{{ $item->contract_invoice }}<br>{{ $item->customer_name }}</strong><br>
                    @endif
                    {{ $item->transaction_method }}<br>
                    {{ $item->transaction_bank_name }}<br>
                    @if ($item->transaction_method == 'bank')
                       AC NO: {{ $item->account_number }} <br> Branch Name: {{ $item->branch_name }}<br>
                    @endif
                    Note : {{ $item->note }}
                </td>
                <td><strong class="text-success">{{ $item->amount }}</strong></td>
                <td></td>
            </tr>
        @elseif($item->getTable() == 'payments')
            <tr class="table-payment bg-danger-subtle">
                <td>
                    {{-- <span
                        class="badge bg-danger text-white text-uppercase fw-bold">Payment</span><br> --}}
                    {{ $item->created_at->format('d-m-y') }}
                </td>
                {{-- <td>{{ $item->receive_type }}</td> --}}
                <td>
                    @if ($item->receive_type == 'customer')
                        <strong>{{ $item->contract_invoice }}<br>{{ $item->customer_name }}</strong><br>
                    @endif
                     {{ $item->transaction_method }}<br>
                     {{ $item->transaction_bank_name }}<br>
                     @if ($item->transaction_method == 'bank')
                     AC NO: {{ $item->account_number }} <br> Branch Name: {{ $item->branch_name }}<br>
                     @endif
                     Note : {{ $item->note }}
                </td>
                <td></td>
                <td><strong class="text-danger">{{ $item->amount }}</strong></td>
            </tr>
        @elseif($item->getTable() == 'tickets')
            <tr class="table-ticket bg-warning-subtle">
                <td>
                    {{ $item->flight_date->format('d-m-y') }}
                </td>
                {{-- <td></td> --}}
                <td>
                    {{ $item->ticket_no }} <br>
                     {{ $item->flight_no }}<br>
                     {{ $item->airline }} / PNR {{ $item->pnr_no }}<br>
                     {{ $item->sector }}
                </td>
                <td><strong class="text-warning">{{ $item->debit }}</strong></td>
                <td><strong class="text-primary">{{ $item->credit }}</strong></td>
            </tr>
        @elseif($item->getTable() == 'contracts')
            <tr class="table-contract bg-secondary-subtle">
                <td>
                    {{ $item->date->format('d-m-y') }}
                </td>
                {{-- <td></td> --}}
                <td>
                     Invoice: {{ $item->invoice_no }}<br>
                     Agent: <strong>{{ $item->agent_name }}</strong><br>
                     Supplier: <strong>{{ $item->supplier_name }}</strong><br>
                     Customer: <strong>{{ $item->customer_name }}</strong>
                </td>
                <td><strong class="text-success">{{ $item->agent_price }}</strong></td>
                <td><strong class="text-danger">{{ $item->supplier_price }}</strong></td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
</div>


