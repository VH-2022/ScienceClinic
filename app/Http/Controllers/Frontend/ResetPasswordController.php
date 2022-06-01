<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\MailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Crypt;

class ResetPasswordController extends Controller
{
    public function ResetPassword(Request $request, $otp)
    {
        $this->data['otp'] = $otp;
        $otpDecrypt = Crypt::decrypt($otp);
        $checkOtp = UserHelper::getByOTP($otpDecrypt);
        if (!empty($checkOtp)) {
            return view('auth.businessreset_password', $this->data);
        } else {
            return view('auth.expire_reset_password');
        }
    }
}
