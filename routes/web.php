<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContractController;

use App\Models\Agent;
use App\Models\Supplier;
use App\Models\Note;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Contract;
use App\Models\Receive;
use App\Models\Payment;

use App\Models\Transaction;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
  
    $notifications = Note::where([
        ['status', 'pending'],
        ['user', Auth::id()]
    ])->orderBy('created_at', 'desc')->get();

    $notificationCount = $notifications->count();

    $totalCashReceive = Receive::where('transaction_method', 'cash')->where('user', Auth::id())->sum('amount');
    $totalBankReceive = Receive::where('transaction_method', 'bank')->where('user', Auth::id())->sum('amount');
    
    $totalCashPayment = Payment::where('transaction_method', 'cash')->where('user', Auth::id())->sum('amount');
    $totalBankPayment = Payment::where('transaction_method', 'bank')->where('user', Auth::id())->sum('amount');
    
    $monthlyTransactions = Transaction::selectRaw('MONTH(created_at) as month, transaction_type, SUM(amount) as total')
    ->where('user', Auth::id()) // Filter by the authenticated user
    ->groupBy(DB::raw('MONTH(created_at)'), 'transaction_type')
    ->get();

    $currentYear = date('Y');
    $currentMonth = date('n'); // Get the current month (1-12)
    
    $transactions = Transaction::where('user', Auth::id())
        ->where('transaction_type', 'bank') 
        ->where('is_delete', 0) // Exclude deleted transactions
        ->get();
    
    $receives = Receive::where('user', Auth::id())->get();
    $payments = Payment::where('user', Auth::id())->get();
    
    // Prepare a collection to hold the totals for each bank
    $bankTotals = [];
    
    // Loop through each transaction to calculate receive and payment totals
    foreach ($transactions as $transaction) {
        // Filter receives for this transaction
        $transactionReceives = $receives->filter(function ($receive) use ($transaction) {
            return ($receive->transaction_method === 'bank' && $receive->bank_name == $transaction->id);
        });
    
        // Filter payments for this transaction
        $transactionPayments = $payments->filter(function ($payment) use ($transaction) {
            return ($payment->transaction_method === 'bank' && $payment->bank_name == $transaction->id);
        });
    
        // Calculate receive and payment totals
        $receiveTotal = $transactionReceives->sum('amount');
        $paymentTotal = $transactionPayments->sum('amount');
    
        // Group totals by bank name
        $bankName = $transaction->bank_name ?? 'No Bank'; // Use 'No Bank' for transactions without a bank_name
    
        if (!isset($bankTotals[$bankName])) {
            $bankTotals[$bankName] = [
                'receive_total' => 0,
                'payment_total' => 0,
            ];
        }
    
        // Accumulate totals
        $bankTotals[$bankName]['receive_total'] += $receiveTotal;
        $bankTotals[$bankName]['payment_total'] += $paymentTotal;
    }
    
    // Prepare data for the chart
    $chartData = collect($bankTotals)->map(function ($totals, $bankName) {
        return [
            'bank_name' => $bankName,
            'receive_total' => $totals['receive_total'],
            'payment_total' => $totals['payment_total'],
        ];
    })->values(); // Reset keys
    
   
// Debug the output
    $lowBalanceThreshold = 500; // Set a minimum balance threshold
    $lowBalanceAccounts = Transaction::where('amount', '<', $lowBalanceThreshold)->where('user', Auth::id())
        ->get();

    $agentProfits = DB::table('contracts')
        ->join('agents', 'contracts.agent', '=', 'agents.id')
        ->selectRaw('agents.name as agent_name, SUM(contracts.agent_price - contracts.supplier_price) as total_profit')
        ->where('contracts.user', Auth::id()) // Filter by authenticated user
        ->groupBy('agents.name')
        ->get();
    
    $supplierProfits = DB::table('contracts')
        ->join('suppliers', 'contracts.supplier', '=', 'suppliers.id')
        ->selectRaw('suppliers.name as supplier_name, SUM(contracts.agent_price - contracts.supplier_price) as total_profit')
        ->where('contracts.user', Auth::id()) // Filter by authenticated user
        ->groupBy('suppliers.name')
        ->get();
    
  
    return view('dashboard', compact('notifications', 'notificationCount', 'totalCashReceive', 'totalCashPayment',
    'totalBankReceive', 'totalBankPayment', 'monthlyTransactions',
    'agentProfits', 'supplierProfits', 'chartData', 'lowBalanceAccounts'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::delete('/services/delete/{id}', [ServiceController::class, 'delete'])->name('services.delete');


// Route::get('/agents/create', [AgentController::class, 'create'])->name('agents.create');
Route::post('/agents', [AgentController::class, 'store'])->name('agents.store');
Route::post('/agents/update', [AgentController::class, 'update'])->name('agents.update');
Route::delete('/agents/delete/{id}', [AgentController::class, 'destroy'])->name('agents.delete');

Route::post('/suppliers', [SupplierController::class, 'store'])->name('supplier.store');
Route::put('/suppliers/update', [SupplierController::class, 'update'])->name('suppliers.update');
Route::delete('/suppliers/delete/{id}', [SupplierController::class, 'destroy'])->name('suppliers.delete');

Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
Route::post('/customers/{id}/update', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::post('/customers/{customer}/details', [CustomerController::class, 'storeCustomerDetails'])->name('customer.details.store');

// Route to show the contract form
Route::get('/contracts', [ContractController::class, 'index'])->name('contract.index');
Route::get('/contracts/create/{customer_id}', [ContractController::class, 'create'])->name('contract.create');
Route::get('/contracts/edit/{id}', [ContractController::class, 'edit'])->name('contract.edit');
Route::put('/contracts/{id}', [ContractController::class, 'update'])->name('contract.update');

// Route to store contract data
Route::post('contract/store', [ContractController::class, 'store'])->name('contract.store');

// Route to display or view contract details
Route::get('contract/{id}', [ContractController::class, 'show'])->name('contract.show');

// Route to delete contract
Route::delete('contract/{id}', [ContractController::class, 'destroy'])->name('contract.destroy');


use App\Http\Controllers\TransactionController;

Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::resource('transactions', TransactionController::class);

use App\Http\Controllers\ReceiveController;

Route::get('/receives', [ReceiveController::class, 'index'])->name('receives.index');
Route::resource('receives', ReceiveController::class);
Route::get('/get-due-amount/{customerId}', [ReceiveController::class, 'getDueAmount']);
Route::get('/receives/receipt/{customer_id}/{receive_id}', [ReceiveController::class, 'receipt'])->name('receives.receipt');

use App\Http\Controllers\PaymentController;

Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::resource('payments', PaymentController::class);
Route::get('/payments/receipt/{customer_id}/{payment_id}', [PaymentController::class, 'receipt'])->name('payments.receipt');
Route::get('/get-payable-amount/{customerId}', [PaymentController::class, 'getPayableAmount']);

use App\Http\Controllers\TicketController;

Route::resource('tickets', TicketController::class);

use App\Http\Controllers\ReportController;

Route::get('/report/statement', [ReportController::class, 'statement'])->name('report.statement');
Route::get('/report/general_ledger', [ReportController::class, 'general_ledger'])->name('report.general_ledger');
Route::post('/report/general_ledger_modified', [ReportController::class, 'general_ledger_modified'])->name('report.general_ledger_modified');
Route::get('/report/cashbook', [ReportController::class, 'cashbook'])->name('report.cashbook');
Route::post('/report/cashbook-report', [ReportController::class, 'cashbook_report'])->name('report.cashbook.report');
Route::get('/report/receive_payment', [ReportController::class, 'receive_payment'])->name('report.receive_payment');
Route::post('/report/receive_payment_report', [ReportController::class, 'receive_payment_report'])->name('report.receive_payment.report');

Route::get('/details/agent', [ReportController::class, 'details_agent'])->name('details.agent');
Route::get('/details/supplier', [ReportController::class, 'details_supplier'])->name('details.supplier');
Route::get('/details/transactions', [ReportController::class, 'details_transaction'])->name('details.transactions');
Route::get('/details/services', [ReportController::class, 'details_service'])->name('details.services');
use App\Http\Controllers\NotesController;

Route::post('/notes', [NotesController::class, 'store'])->name('notes.store');

Route::get('/notifications/fetch', function (Request $request) {
    if (Auth::check()) {
        $notifications = Note::where([
            ['status', 'pending'],
            ['user', Auth::id()]
        ])->orderBy('created_at', 'desc')->get();

        // Mark notifications as read
        // Note::where('user', Auth::id())->update(['status' => 'read']);
        // dd($notifications);
        return response()->json([
            'notifications' => $notifications
        ]);
        
    }
    return response()->json(['notifications' => []], 403);
})->name('notifications.fetch');
Route::post('/notifications/update', [NotesController::class, 'updateStatus'])->name('notifications.update');
Route::post('/notifications/updateDescription', [NotesController::class, 'updateDescription'])->name('notifications.updateDescription');

use App\Http\Controllers\PreviousDueController;

Route::post('/previous-due/store', [PreviousDueController::class, 'store'])->name('previousDue.store');
Route::get('/previous-due', [PreviousDueController::class, 'index'])->name('previousDue.index');
Route::delete('/previous-due/delete/{id}', [PreviousDueController::class, 'destroy'])->name('previousDue.delete');

use App\Http\Controllers\BkashTokenizePaymentController;

Route::group(['middleware' => ['web']], function () {
    // Payment Routes for bKash
    Route::get('/bkash/payment/{user_id}', [App\Http\Controllers\BkashTokenizePaymentController::class, 'index'])
    ->name('bkash.payment.page'); 
    Route::get('/bkash/create-payment/{user_id}', [App\Http\Controllers\BkashTokenizePaymentController::class,'createPayment'])->name('bkash-create-payment');
    // Route::get('/bkash/callback/{user_id}', [App\Http\Controllers\BkashTokenizePaymentController::class, 'callBack'])
    // ->name('bkash-callBack');
    Route::get('/bkash/callback', [App\Http\Controllers\BkashTokenizePaymentController::class, 'callBack'])
    ->name('bkash-callBack');


    //search payment
    Route::get('/bkash/search/{trxID}', [App\Http\Controllers\BkashTokenizePaymentController::class,'searchTnx'])->name('bkash-serach');

    //refund payment routes
    Route::get('/bkash/refund', [App\Http\Controllers\BkashTokenizePaymentController::class,'refund'])->name('bkash-refund');
    Route::get('/bkash/refund/status', [App\Http\Controllers\BkashTokenizePaymentController::class,'refundStatus'])->name('bkash-refund-status');

});