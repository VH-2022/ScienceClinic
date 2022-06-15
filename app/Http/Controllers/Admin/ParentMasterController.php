<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MailHelper;
use App\Helpers\ParentDetailHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Session;

class ParentMasterController extends Controller
{
   public function index()
   {
        return view('admin.parent.parent_list');  
   }
    public function ajaxList(Request $request)
    {

        $data['page'] = $request->page;
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $status = $request->status;

        $created_date = $request->created_date;

        $data['query'] = UserHelper::getParentList($name,$email,$phone,$address,$status,$created_date);
   
        return view('admin.parent.parent_list_ajax', $data);
    }

    public static function parentDetails($id)
    {
        
        $data['parents'] = UserHelper::getDetailsById($id);

        if (isset($data['parents']->id)) {

            return view('admin.parent.parent_details', $data);
        } else {

            abort(404);
        }
    }

    public function sendPaymentLinkMail(Request $request){
        if($request->id !=''){
            $string = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            $rand =  substr(str_shuffle($string), 0, 8);
            $encrypted = Crypt::encrypt($rand);
            $update = ParentDetailHelper::update(array('payment_link_flag' => '1','payment_token' => $rand,'updated_at' => date('Y-m-d H:i:s')),array('id'=>$request->id));
            $getUserData = ParentDetailHelper::getUserDetails($request->id);
            if($getUserData){

                //send mail to parent for payment
                $html = '<p>Admin has sent you a payment request for subject '.$getUserData->subjectDetails->main_title.'.</p><p>Please click on the link below to make a secure online payment:</p>
                <h5>Stirpe</h5>
                <a href="' . URL::to('/stripe-payment/' . $encrypted) . '">' . URL::to('/stripe-payment/' . $encrypted) . '</a>
                <br/>
                <h5>Paypal</h5>
                <a href="' . URL::to('/paypal-payment/' . $encrypted) . '">' . URL::to('/stripe-payment/' . $encrypted) . '</a>';
                $subject = __('emails.payment_email');
                $BODY = __('emails.payment_email_body', ['USERNAME' => $getUserData->userDetails->first_name, 'HTMLTABLE' => $html]);
                $body_email = __('emails.template', ['BODYCONTENT' => $BODY]);
                $mail = MailHelper::mail_send($body_email, $getUserData->userDetails->email, $subject);
                return 1;
            }else{
                return 0;
            }
            
        }else{
            return 0;
        }
    }
    public function getCalanderBooking(Request $request){
        $data['parent_id'] = $request->id;
        return view('admin.parent.parent_calander_list', $data);
    }
    public function getParentBookLesson(Request $request){
        $data = ParentDetailHelper::getBooklessondata($request->parentID);
        return response()->json($data);
    }
    public function getInquiryDetails(Request $request)
    {

        $data['page'] = $request->page;
        $tutor_id = $request->tutor_id;
        $data['query'] = ParentDetailHelper::getListwithPaginate($tutor_id);
      

        return view('admin.parent.tutor_inquiry_list', $data);
    }

    public function destroy($id)

    {
  

        $update = UserHelper::SoftDelete(array(), array('id' => $id));

        if ($update) {

            return response()->json([

                'message' => trans('messages.deletedSuccessfully')

            ]);
        } else {

            return response()->json([

                'message' =>  trans('messages.notDeleted')

            ]);
        }
    }
}
