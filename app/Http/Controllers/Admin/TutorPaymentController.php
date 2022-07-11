<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MailHelper;
use App\Helpers\ParentDetailHelper;
use App\Helpers\ParentPaymentHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Session;

class TutorPaymentController extends Controller
{
   public function index()
   {
        return view('admin.tutor.tutor_payment_list');  
   }

   public function tutorUnpaidList()
   {
        return view('admin.tutor.tutor_unpaid_payment_list');  

   }
    public function ajaxList(Request $request)
    {
        $data['page'] = $request->page;
        $name = $request->name;
      
        $created_date = $request->created_date;

        $data['query'] = ParentPaymentHelper::getPaidListwithPaginate($name,$created_date);
       
        return view('admin.tutor.tutor_payment_list_ajax', $data);
    }

    public function tutorPayamount(Request $request){
        
        $id = $request->id;
        $updateArray = array('tutor_pay_amount' => $request->tutorAmount,'tutor_pay_date_time' => date('Y-m-d H:i:s'),'tutor_payment_status' => 'Success');
        $update = ParentPaymentHelper::update($updateArray,array('id' => $id));
        if($update){
            return response()->json(['error_msg' => trans('messages.paymentaddedSuccessfully'), 'data' => array()], 200);
        }else {
            return response()->json(['error_msg' => trans('messages.error_msg'),'data' => array()], 500);
        }
    }

    public function ajaxListUnpaid(Request $request)
    {
        $data['page'] = $request->page;
        $name = $request->name;

        $created_date = $request->created_date;

        $data['query'] = ParentPaymentHelper::getUnPaidListwithPaginate($name, $created_date);

        return view('admin.tutor.tutor_unpaid_payment_list_ajax', $data);
    }

    public function payMultipleTutorsAmount(Request $request)
    {
        foreach($request->data as $value){
            $testData = explode(",", $value);
            $id = $testData[0];
            $payAmmount = $testData[1];
            $updateArray = array('tutor_pay_amount' => $payAmmount, 'tutor_pay_date_time' => date('Y-m-d H:i:s'), 'tutor_payment_status' => 'Success');
            $update = ParentPaymentHelper::update($updateArray, array('id' => $id));
        }
       
        if ($update) {
            return response()->json(['error_msg' => trans('messages.paymentaddedSuccessfully'), 'data' => array()], 200);
        } else {
            return response()->json(['error_msg' => trans('messages.error_msg'), 'data' => array()], 500);
        }
    }
    public function getPaymentHistory(){
        return view('admin.tutor.tutor_payment_history_list'); 
    }
    public function ajaxHistoryList(Request $request)
    {
        $data['page'] = $request->page;
        $name = $request->name;
        $created_date = $request->created_date;
        $data['query'] = ParentPaymentHelper::getPaidListwithPaginate($name,$created_date);
        return view('admin.tutor.tutor_payment_history_list_ajax', $data);
    }
}
