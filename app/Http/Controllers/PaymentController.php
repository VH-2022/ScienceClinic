<?php

namespace App\Http\Controllers;

use App\Helpers\MailHelper;
use App\Helpers\ParentDetailHelper;
use App\Helpers\SiteSettingHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ParentPayment;
use Error;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Stripe;
use Session;

class PaymentController extends Controller
{
   public function stripePayment(Request $request,$id)
   {
        $data['id'] = $tokenid = Crypt::decrypt($id);
        $getParentPymenttoken = ParentDetailHelper::getPaymenttoken($tokenid);
        if($getParentPymenttoken){
            $totalAmount = $getParentPymenttoken->teaching_hours * $getParentPymenttoken->hourly_rate;
            // add commission
            $getSitesetting = SiteSettingHelper::getSettingdata(1);
            $grandTotal = ($totalAmount * isset($getSitesetting->commission_value) ? $getSitesetting->commission_value : 0) / 100;
            $data['total'] = $totalAmount + $grandTotal;
            $data['total_commision'] = $grandTotal;
            return view('payment.stripe_payment',$data);  
        }else{
            abort(404);
        }
        
   }

   public function paypalPayment(Request $request,$id){
        $paymentID = Crypt::decrypt($id);
        $getParentPymenttoken = ParentDetailHelper::getPaymenttoken($paymentID);
        if($getParentPymenttoken){


            $totalAmount = $getParentPymenttoken->teaching_hours * $getParentPymenttoken->hourly_rate;
            // add commission
            $getSitesetting = SiteSettingHelper::getSettingdata(1);
            $grandTotal = ($totalAmount * isset($getSitesetting->commission_value) ? $getSitesetting->commission_value : 0) / 100;
            $data['paypalNew'] = $totalAmount + $grandTotal;
            $data['total_commision'] = $grandTotal;
            $data['user_id'] = $getParentPymenttoken->user_id;
            $data['user_inquiry_id'] = $getParentPymenttoken->user_inquiry_id;
            return view('payment.index',$data);  
        }else{
            abort(404);
        }
        
   }
   public function ipn(Request $request)
    {

        $paymentDetail = json_encode($_POST);
        $paymentData = array(
            "ipn_log" => $paymentDetail,
        );
        $insert = new ParentPayment($paymentData);
        $insert->save();
    }
    public function payment_script_status(Request $request)
    {

        $payment_status = $request->input('payment_status');
        $txn_id = $request->input('txn_id');
        $payment_gross = $request->input('payment_gross');
        $item_number = $request->input('item_number');
        $item_name = $request->input('item_name');
        $paymentDetail = json_encode($_POST);


        $paymentData = array(
            "user_id" => $request->input('id'),
            "user_inquiry_id" => $item_number,
            'pay_amount' => $payment_gross,
            'total_commision' => $item_name,
            "payment_type" => 'paypal',
            "payment_status" => 'success',
            "payment_json" => $paymentDetail,
            "created_at" => date('Y-m-d H:i:s'),
        );
        $insert = new ParentPayment($paymentData);
        $insert->save();
        $insertId = $insert->id;
        $getParentPymenttoken = ParentDetailHelper::getPaymenttoken($request->input('id'));
        $update = ParentDetailHelper::update(array('payment_status' => 'Success','payment_token' => null,'updated_at' => date('Y-m-d H:i:s')),array('id' => $request->input('id')));

        Session::flash('success',trans('messages.paymentaddedSuccessfully'));
                return redirect('/parent-login');
    }
   public function redirectPayment(Request $request){
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = \Stripe\Customer::create(array(
            'name' => $request->name,
            'source' => $request->stripeToken
        ));
        $price = $request->pay_amount;
        $total_commision = $request->total_commision;
        $stripe_customer_id = $customer->id;
        $randomNo = substr(str_shuffle("0123456789"), 0, 4);
        $order_number = date('Ymdhis'). $randomNo;
        $currency = "eur";
        $itemName = "Order Payment";
        $itemNumber = $order_number;
        $itemPrice = $price * 100;
        $charge = \Stripe\Charge::create(array(
            'customer' => $stripe_customer_id,
            'amount' => $itemPrice,
            'currency' => $currency,
            'description' => $itemNumber,
            'metadata' => array(
                'item_id' => $itemNumber
            )
        ));
        $chargeJson = $charge->jsonSerialize();
       
        if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1 && $chargeJson['status'] == 'succeeded') {
            $getParentPymenttoken = ParentDetailHelper::getPaymenttoken($request->parent_token);
            if($getParentPymenttoken){
                $insertArray = array(
                    'user_id' => $getParentPymenttoken->user_id,
                    'user_inquiry_id' => $getParentPymenttoken->id,
                    'pay_amount' => $price,
                    'total_commision' => $total_commision,
                    'payment_type' => 'stripe',
                    'payment_status' => 'success',
                    'payment_json' => json_encode($chargeJson),
                    'created_at' => date('Y-m-d H:i:s'),
                );
                $insert = new ParentPayment($insertArray);
                $insert->save();

                $update = ParentDetailHelper::update(array('payment_status' => 'Success','payment_token' => null,'updated_at' => date('Y-m-d H:i:s')),array('id' => $getParentPymenttoken->id));

                Session::flash('success',trans('messages.paymentaddedSuccessfully'));
                return redirect('/parent-login');
            }else{
                Session::flash('error',trans('messages.error'));
                return back();
            }
        }

   }
    
}
