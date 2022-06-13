<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\MailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Crypt;
use Illuminate\Support\Facades\URL;

class ForgotPasswordController extends Controller
{
    public function index(){
        $data['title'] = "Forgot Password";
        return view('frontend.forgot_password.forgot_password', $data);
    }
    public function ForgotPasswordVerify(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);
        $email = request('email');
        /* Create OTP */
        $rand = mt_rand(1000, 9999);
        /* Create OTP */
        $checkEmail = UserHelper::getUserByEmail($email);
        if ($checkEmail) {
            $string = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            $rand =  substr(str_shuffle($string), 0, 8);
            $encrypted = Crypt::encrypt($rand);
            $html = '<p>A request to reset your Account password has been made. If you did not make this request, simply ignore this email. If you did make this request, please reset your password:</p>
            <center>
                <a href="' . URL::to('/user-reset-password/' . $encrypted) . '" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 13px; color: #fff; border-color: #0f7dc2; background: #0f7dc2 !important; border-radius: 5px; text-decoration:none; font-weight: 500;">Reset Password</a>
            </center>';
            $subject = __('emails.forgot_email');
            $BODY = __('emails.forgot_email_body', ['USERNAME' => $checkEmail->first_name, 'HTMLTABLE' => $html]);
            $body_email = __('emails.template', ['BODYCONTENT' => $BODY]);
            $mail = MailHelper::mail_send($body_email, $email, $subject);
            $update = UserHelper::updateOTP($email, $rand);
            $checkdata = UserHelper::getUserByEmail($email);
            Session::flash('success', trans('messages.successMail'));
            if($checkdata->type == "2"){
                return redirect('tutor-login');
            }
            else{
                return redirect('parent-login');
            }
        } else {
            Session::flash('error', trans('messages.errorWrongMail'));
            return redirect()->route('forgot-password');
        }
    }
}
