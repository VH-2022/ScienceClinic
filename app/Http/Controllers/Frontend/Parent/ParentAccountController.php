<?php

namespace App\Http\Controllers\Frontend\Parent;

use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ParentAccountController extends Controller
{
    public function index()
    {
        return view('frontend.parent.parent_account');
    }
    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $data =  UserHelper::checkDuplicateEmailTutor($email);
        if ($data != 0) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function parentUpdate(Request $request)
    {
        
    }
}
