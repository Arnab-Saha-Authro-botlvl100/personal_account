<div class="mb-3">
    {{-- <h5 class="fw-bold">Opening Balance:</h5> --}}
    {{-- <p class="mb-0">
        @if ($type === 'agent')
            <span class="text-success">Debit: {{ number_format($opening_balance, 2) }}</span>
        @elseif ($type === 'supplier')
            <span class="text-danger">Credit: {{ number_format($opening_balance, 2) }}</span>
        @else
            <span>N/A</span>
        @endif
    </p> --}}
</div>

<table class="table table-bordered">
    <thead class="table-dark text-center">
        <tr>
            <th>SL</th>
            <th>Date</th>
            <th>Description</th>
            <th>Debit (Cash In)</th>
            <th>Credit (Cash Out)</th>
        </tr>
    </thead>
    <tbody>
        @php
            $sl = 1;
            $totalDebit = 0;
            $totalCredit = 0;
        @endphp

        <!-- Opening Balance Row -->
        <tr class="table-warning fw-bold">
            <td>-</td> <!-- No SL Number -->
            <td>Opening Balance</td>
            <td>Initial Balance</td>
            <td class="text-success">
                @if ($type === 'agent')
                    {{ number_format($opening_balance, 2) }}
                    @php $totalDebit += $opening_balance; @endphp
                @else
                    -
                @endif
            </td>
            <td class="text-danger">
                @if ($type === 'supplier')
                    {{ number_format($opening_balance, 2) }}
                    @php $totalCredit += $opening_balance; @endphp
                @else
                    -
                @endif
            </td>
        </tr>

        <!-- Receives Data (Debit Entries) -->
        @foreach ($receivesData as $receive)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $receive->date }}</td>
                <td>
                    <strong>{{ $receive->customer_name ?? 'N/A' }}</strong><br>
                    Invoice: {{ $receive->contract_invoice ?? 'N/A' }}<br>
                    Method: {{ $receive->transaction_method == 'bank' ? 'Bank' : 'Cash' }}<br>
                    @if ($receive->transaction_method == 'bank')
                        Bank: {{ $receive->bank_name ?? 'N/A' }}
                    @endif
                </td>
                <td class="text-success">
                    {{ number_format($receive->amount, 2) }}
                    @php $totalDebit += $receive->amount; @endphp
                </td>
                <td>-</td>
            </tr>
        @endforeach

        <!-- Payments Data (Credit Entries) -->
        @foreach ($paymentsData as $payment)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $payment->date }}</td>
                <td>
                    <strong>{{ $payment->customer_name ?? 'N/A' }}</strong><br>
                    Invoice: {{ $payment->contract_invoice ?? 'N/A' }}<br>
                    Method: {{ $payment->transaction_method == 'bank' ? 'Bank' : 'Cash' }}<br>
                    @if ($payment->transaction_method == 'bank')
                        Bank: {{ $payment->bank_name ?? 'N/A' }}
                    @endif
                </td>
                <td>-</td>
                <td class="text-danger">
                    {{ number_format($payment->amount, 2) }}
                    @php $totalCredit += $payment->amount; @endphp
                </td>
            </tr>
        @endforeach

        <!-- Totals Row -->
        <tr class="table-secondary text-center fw-bold">
            <td colspan="3">Total</td>
            <td class="text-success">{{ number_format($totalDebit, 2) }}</td>
            <td class="text-danger">{{ number_format($totalCredit, 2) }}</td>
        </tr>
    </tbody>
</table>
