<table class="table table-bordered table-hover">
    <thead class="table-dark text-center">
        <tr>
            <th>Date</th>
            <th>Invoice/Customer ID/Type</th>
            <th>Details</th>
            <th>Agent Contact</th>
            <th>Supplier Contact</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sorted as $item)
            @if ($item->getTable() == 'customers')
                <tr class="table-customer bg-info-subtle">
                    <td>
                        <span
                            class="badge bg-info text-white text-uppercase fw-bold">Customer</span><br>
                        {{ $item->created_at->format('d-m-y') }}
                    </td>
                    <td>{{ $item->customer_id }}</td>
                    <td>
                        <strong>{{ $item->name }}</strong><br>
                        📞 {{ $item->phone_number }}<br>
                        🛂 {{ $item->passport_number }}
                    </td>
                    <td><strong class="text-success">{{ $item->agent_contract }}</strong></td>
                    <td><strong class="text-danger">{{ $item->supplier_contract }}</strong></td>
                </tr>
            @elseif($item->getTable() == 'receives')
                <tr class="table-receive bg-success-subtle">
                    <td>
                        <span
                            class="badge bg-success text-white text-uppercase fw-bold">Receive</span><br>
                        {{ $item->created_at->format('d-m-y') }}
                    </td>
                    <td>{{ $item->receive_type }}</td>
                    <td>
                        <strong>{{ $item->contract_invoice }}/{{ $item->customer_name }}</strong><br>
                        🏦 {{ $item->transaction_method }}<br>
                        🏛 {{ $item->transaction_bank_name }}<br>
                        💳 {{ $item->account_number }}/ {{ $item->branch_name }}<br>
                        📝 {{ $item->note }}
                    </td>
                    <td><strong class="text-success">{{ $item->amount }}</strong></td>
                    <td>N/A</td>
                </tr>
            @elseif($item->getTable() == 'payments')
                <tr class="table-payment bg-danger-subtle">
                    <td>
                        <span
                            class="badge bg-danger text-white text-uppercase fw-bold">Payment</span><br>
                        {{ $item->created_at->format('d-m-y') }}
                    </td>
                    <td>{{ $item->receive_type }}</td>
                    <td>
                        <strong>{{ $item->contract_invoice }}/{{ $item->customer_name }}</strong><br>
                        💳 {{ $item->transaction_method }}<br>
                        🏛 {{ $item->transaction_bank_name }}<br>
                        🔢 {{ $item->account_number }}/ {{ $item->branch_name }}<br>
                        📝 {{ $item->note }}
                    </td>
                    <td>N/A</td>
                    <td><strong class="text-danger">{{ $item->amount }}</strong></td>
                </tr>
            @elseif($item->getTable() == 'tickets')
                <tr class="table-ticket bg-warning-subtle">
                    <td>
                        <span
                            class="badge bg-warning text-dark text-uppercase fw-bold">Ticket</span><br>
                        {{ $item->flight_date->format('d-m-y') }}
                    </td>
                    <td>{{ $item->ticket_no }}</td>
                    <td>
                        ✈️ {{ $item->flight_no }}<br>
                        🏷️ {{ $item->airline }} / PNR {{ $item->pnr_no }}<br>
                        📍 {{ $item->sector }}
                    </td>
                    <td><strong class="text-warning">{{ $item->debit }}</strong></td>
                    <td><strong class="text-primary">{{ $item->credit }}</strong></td>
                </tr>
            @elseif($item->getTable() == 'contracts')
                <tr class="table-contract bg-secondary-subtle">
                    <td>
                        <span
                            class="badge bg-secondary text-white text-uppercase fw-bold">Contract</span><br>
                        {{ $item->date->format('d-m-y') }}
                    </td>
                    <td>{{ $item->invoice_no }}</td>
                    <td>
                        👤 Agent: <strong>{{ $item->agent_name }}</strong><br>
                        🚛 Supplier: <strong>{{ $item->supplier_name }}</strong><br>
                        👨‍💼 Customer: <strong>{{ $item->customer_name }}</strong>
                    </td>
                    <td><strong class="text-success">{{ $item->agent_price }}</strong></td>
                    <td><strong class="text-danger">{{ $item->supplier_price }}</strong></td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>