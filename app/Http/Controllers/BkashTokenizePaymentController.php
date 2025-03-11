<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Carbon\Carbon;

class BkashTokenizePaymentController extends Controller
{
    public function index($id)
    {
        // return view('bkashT::bkash-payment');
        $user = User::findOrFail($id);
        return view('bkash.bkash-payment', compact('user'));
    }

   

    public function createPayment(Request $request, $id)
    {
        // dd($request->all(), $id);
        $user_id = $id; // Retrieve stored user ID
        $user = User::findOrFail($user_id);
        // dd($user);
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; // 0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = 1;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");
        $request['user_id'] = $user_id;
        $request_data_json = json_encode($request->all());
        $request['callbackURL'] = str_replace('{user_id}', $user_id, config("bkash.callbackURL")); // Replace user_id dynamically

        $response = BkashPaymentTokenize::cPayment($request_data_json);
        // dd($response['paymentID']);
        Log::info('Create payment request: ', ['response' => $response]);
    
        if (isset($response['bkashURL'])) {
           
            $user->last_payment_id = $response['paymentID'];
            $user->save();
            return redirect()->away($response['bkashURL']);

        } else {
            $errorMessage = $response['statusMessage'] ?? 'Something went wrong. Please try again.';
            return redirect()->back()->with('error-alert2', $errorMessage);
        }
    }

    // public function callBack(Request $request, $id)
    // {
    //     //callback request params
    //     // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
    //     //using paymentID find the account number for sending params

    //     dd($id);
    //     if ($request->status == 'success'){
    //         $response = BkashPaymentTokenize::executePayment($request->paymentID);
    //         //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    //         if (!$response){ //if executePayment payment not found call queryPayment
    //             $response = BkashPaymentTokenize::queryPayment($request->paymentID);
    //             //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    //         }

    //         if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
    //             /*
    //              * for refund need to store
    //              * paymentID and trxID
    //              * */
    //             return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
    //         }
    //         return BkashPaymentTokenize::failure($response['statusMessage']);
    //     }else if ($request->status == 'cancel'){
    //         return BkashPaymentTokenize::cancel('Your payment is canceled');
    //     }else{
    //         return BkashPaymentTokenize::failure('Your transaction is failed');
    //     }
    // }
    public function callBack(Request $request)
    {
        // Log callback request for debugging
        Log::info('bKash Callback Received', $request->all());
    
        if ($request->status == 'success') {
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
    
            if (!$response) { // If executePayment fails, try queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
            }
    
            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                // Find user based on paymentID (assuming you store this during createPayment)
                $user = User::where('last_payment_id', $request->paymentID)->first();
    
                if ($user) {
                    $user->last_payment_date = now();
                    $user->next_payment_date = now()->addMonth();
                    $user->payment_status = 'completed';
                    $user->save();
    
                    // Redirect to login with success message
                    return redirect()->route('login')->with('success', 'Payment successful! Please log in.');
                } else {
                    return redirect()->route('bkash.payment.page', ['user_id' => 'unknown'])->with('error', 'User not found.');
                }
            }
    
            return redirect()->route('bkash.payment.page', ['user_id' => $user->id ?? 'unknown'])
                ->with('error', $response['statusMessage']);
        } elseif ($request->status == 'cancel') {
            return redirect()->route('bkash.payment.page', ['user_id' => 'unknown'])
                ->with('error', 'Your payment was canceled.');
        } else {
            return redirect()->route('bkash.payment.page', ['user_id' => 'unknown'])
                ->with('error', 'Your transaction failed.');
        }
    }
    


    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        $amount=5;
        $reason='this is test reason';
        $sku='abc';
        //response
        return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID,$trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
