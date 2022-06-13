<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\MailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Crypt;
use Illuminate\Support\Facades\Hash;
use Validator;

class ResetPasswordController extends Controller
{
    public function ResetPassword(Request $request, $otp)
    {
        $data['title'] = "Reset Password";
        $this->data['otp'] = $otp;
        $otpDecrypt = Crypt::decrypt($otp);
        $checkOtp = UserHelper::getByOTP($otpDecrypt);
        if (!empty($checkOtp)) {
            return view('frontend.reset_password.reset-password', $this->data);
        } else {
            return view('frontend.reset_password.expire-reset-password');
        }
    }
    public function UpdatePassword(Request $request, $otpen){
        $otp = Crypt::decrypt($otpen);
        $password = request('password');
        $rules = array(
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).{6,}$/',
            'confirm_password' => 'required|same:password|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).{6,}$/',
        );
        $messsages = array(
            'password.regex' => 'Password should include 6 charaters, alphabets, numbers and special characters',
            'confirm_password.regex' => 'Password should include 6 charaters, alphabets, numbers and special characters'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return redirect("user-reset-password/" . $otpen)
                ->withErrors($validator)
                ->withInput();
        } else {
            $checkdata = UserHelper::getByOTP($otp);
            if ($checkdata) {
                $data = array('password' => Hash::make($password), 'otp' => null);
                $update = UserHelper::updatePassword($otp, $data);;
                if ($update) {
                    Session::flash('success', trans('messages.updatedSuccessfully'));
                    if($checkdata->type == "2"){
                        return redirect('tutor-login');
                    }
                    else{
                        return redirect('parent-login');
                    }
                } else {
                    Session::flash('error', trans('messages.error'));
                    return redirect()->back();
                }
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect('forgot-password');
            }
        }
    }
}
