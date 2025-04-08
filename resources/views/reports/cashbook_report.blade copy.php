<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
 
  <style>
    .hide-scroll-bar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    .hide-scroll-bar::-webkit-scrollbar {
      display: none;
    }
  </style>
</head>

<body class="flex">
  
  <main class="flex-1 mx-auto max-w-7xl px-10">
   <!-- <div class="buttons justify-end flex gap-3 shadow-lg p-5 ">
      <button class="text-white bg-pink-600 font-bold text-md py-2 px-4">Send</button>
      <button class="text-white bg-blue-700 font-bold text-md py-2 px-4">Print</button>
      <button class="text-white bg-green-600 font-bold text-md py-2 px-4 ">ADD NEW INVOICE</button>
      <button class="text-white bg-black font-bold text-md py-2 px-4">GO BACK</button>
   </div> -->
   <div class="">
        <h2 class="text-center font-bold text-3xl my-2">Cash Book</h2>
        <h2 class="text-center font-bold text-xl my-2"> Account : All</h2>
        <div class="flex items-center justify-between mb-2">
            <div class="text-lg">
                <h2 class="font-semibold">Company Name : {{Auth::user()->name}}</h2>
                <p><span class="font-semibold">Period Date :</span> {{$start_date}} to {{$end_date}} </p>
            </div>
            <div class="flex items-center">
               
                
            </div>
        </div>
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
              <tr>
                  <th>Date</th>
                  <th>Type</th>
                  <th>Description</th>
                  <th>Transaction Method</th>
                  <th>Debit</th>
                  <th>Credit</th>
              </tr>
          </thead>
          <tbody>
              @foreach($mergedData as $transaction)
              <tr>
                  <td>{{ $transaction->date }}</td>
                  <td>{{ $transaction instanceof App\Models\Receive ? 'Receive' : 'Payment' }}</td>
                  <td>{{ $transaction->note }}</td>
                  <td>{{ $transaction->transaction_method == 'cash' ? 'Cash' : $getBankName($transaction->bank_name) }}</td>                  <td>
                      @if($transaction instanceof App\Models\Receive)
                          {{ number_format($transaction->amount, 2) }}
                      @else
                          -
                      @endif
                  </td>
                  <td>
                      @if($transaction instanceof App\Models\Payment)
                          {{ number_format($transaction->amount, 2) }}
                      @else
                          -
                      @endif
                  </td>
              </tr>
              @endforeach
          </tbody>
          <tfoot>
              <tr>
                  <th colspan="4" class="text-end">Total</th>
                  <th>{{ number_format($totalDebit, 2) }}</th>
                  <th>{{ number_format($totalCredit, 2) }}</th>
              </tr>
          </tfoot>
        </table>
   </div>


  </main>
 
</body>

</html>