<?php

namespace App\Http\Controllers\Admin;

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
            return view('auth.reset-password', $this->data);
        } else {
            return view('auth.expire-reset-password');
        }
    }
    public function UpdatePasswordAdmin(Request $request, $otpen){
        $otp = Crypt::decrypt($otpen);
        $password = request('password');
        $rules = array(
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).*$/',
            'confirm_password' => 'required|same:password|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).*$/',
        );
        $messsages = array(
            'password.regex' => 'Password should be include 6 charaters, alphabets, numbers and special characters',
            'confirm_password.regex' => 'Password should be include 6 charaters, alphabets, numbers and special characters'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return redirect("user-reset-password" . $otpen)
                ->withErrors($validator, 'reset')
                ->withInput();
        } else {
            $checkdata = UserHelper::getByOTP($otp);
            if ($checkdata) {
                $data = array('password' => Hash::make($password), 'otp' => null);
                $update = UserHelper::updatePassword($otp, $data);;
                if ($update) {
                    Session::flash('success', trans('messages.updatedSuccessfully'));
                    return redirect('login');
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
