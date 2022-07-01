<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ContactHelper;
use App\Helpers\MailHelper;
use App\Helpers\UserHelper;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact.contact');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:255',
            'phone_no' => 'required',
            'tutor_type' => 'required',
            'email' => 'required|email|regex:/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i',
            'address' => 'required',
            'message' => 'required'
        ]);


        if ($validator->fails()) {
            response()->json(['error_msg' => $validator->errors()->all(),  'data' => array()], 400);
        }
        $data_array = array(
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'tutor_type' => $request->tutor_type,
            'email' => $request->email,
            'address' => $request->address,
            'message' => $request->message

        );

        $update = ContactHelper::save($data_array);
        if ($update) {
            $adminData = UserHelper::getAdminData();
            $email = $adminData->email;
            $html = '
                    <p class="mb-0">Name : <span>' . $request->name . '</span></p>
                    <p class="mb-0">Phone No : <span>' . $request->phone_no . '</span></p>
                    <p class="mb-0">Tutor Type : <span>' . $request->tutor_type . '</span></p>
                    <p class="mb-0">Email : <span>' . $request->email . '</span></p>
                    <p class="mb-0">Address : <span>' . $request->address . '</span></p>
                    <p class="mb-0">Message : <span>' . $request->message . '</span></p>
                ';
            $subject = __('emails.contact_us');
            $body = __('emails.contact_us_body', ['USERNAME' => 'Admin', 'HTMLTABLE' => $html]);
            $body_email = __('emails.template', ['BODYCONTENT' => $body]);
            $mail = MailHelper::mail_send($body_email, $email, $subject);
            $checkdata = UserHelper::getUserByEmail($email);
            Session::flash('success', trans('messages.successMail'));
            return response()->json(['error_msg' => trans('messages.addedSuccessfully'), 'data' => array()], 200);
        } else {
            return response()->json(['error_msg' => trans('messages.error'), 'data' => array()], 500);
        }
    }
}
