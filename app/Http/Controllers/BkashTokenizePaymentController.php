<?php

namespace App\Http\Controllers;

use App\Models\Bkash;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;

class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }
    public function createPayment(Request $request){

        $data_info = session('data');
        foreach($data_info as $data){
            $customer_id = $data['customer_id'];
            $name = $data['name'];
            $email = $data['email'];
            $phone_number = $data['phone_number'];
            $plan_name = $data['plan_name'];
            $amount = $data['price'];
            $payment_method = $data['payment_method'];
        };
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = $amount;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");

        $request_data_json = json_encode($request->all());
        $response =  BkashPaymentTokenize::cPayment($request_data_json);
    
        

        Bkash::insert([
            'customer_id'=>$customer_id,
            'name'=>$name,
            'email'=>$email,
            'phone_number'=>$phone_number,
            'plan_name'=>$plan_name,
            'price'=>$amount,
            'payment_method'=>$payment_method,
            'payerReference'=>$inv,
            'created_at'=>Carbon::now(),
        ]);


        
        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

        //store paymentID and your account number for matching in callback request
        // dd($response) //if you are using sandbox and not submit info to bkash use it for 1 response

        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error-alert2', $response['statusMessage']);
    }

    public function callBack(Request $request){
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params 

        if ($request->status == 'success'){

            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response){ //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont.. 
            }
            
            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID 
                 * */             
                // $data_info = session('data');
                // Order::insert([
                //      'name'=>$data_info['name'],
                //      'email'=>$data_info['email'],
                //      'phone'=>$data_info['phone_number'],
                //      'plan_name'=>$data_info['plan_name'],
                //      'price'=>$data_info['price'],
                //      'payment_method'=>$data_info['payment_method'],
                //      'bkash_token'=>$request->paymentID,
                //      'created_at'=>Carbon::now(),
                //  ]);  

                return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
           
        return BkashPaymentTokenize::failure($response['statusMessage']);

       
        }
        
        else if ($request->status == 'cancel'){
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{
            return BkashPaymentTokenize::failure('Your transaction is failed');
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
