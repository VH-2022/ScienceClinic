<?php

namespace App\Http\Controllers\Frontend\Parent;

use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ParentAccountController extends Controller
{
    public function index()
    {
        return view('frontend.parent.parent_account');
    }
    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $data =  UserHelper::checkDuplicateEmailParent($email);
        if ($data != 0) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function parentUpdate(Request $request)
    {
      
        $userId = Auth()->user()->id;

        $validator = Validator::make($request->all(), [

            'firstname' => 'required|max:30',

            'lastname' => 'required|max:30',

            'email' => 'required|max:30',

            'telephone' => 'required',
            'address' => 'required',

        ]);
        if ($validator->fails()) {

            return response()->json(['message' => $validator->errors(), 'status' => 0], 400);
        } else {
            $data = array(
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'email' => $request->email,
                'mobile_id' => $request->telephone,
                'address1' => $request->address,
            );
          $userData = UserHelper::update($data, array(['id',$userId]));
          if($userData){
            $data['fullname'] = $request->firstname .' '. $request->lastname;

            return response()->json(['error_msg' => "Successfully updated", 'data' => $data], 200);
            }else{
                return response()->json(['error_msg' => "Something went wrong", 'data' => ''], 400);
            }
        }
    }

    public function checkOldPassword(Request $request)
    {

        $pwd = $request->pwd;
        $auth = Auth::guard('parent')->user();
        $password = $auth['password'];
        if (Hash::check($pwd, $password)) {
            return response()->json(['status' => 0]);
        } else {
            return response()->json(['status' => 1]);
        }
    }

    public function updatePassword(Request $request)

    {
        $auth  = auth()->user();
        $rules = array(
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).*$/',
            'confirmpassword' => 'required|same:newpassword|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).*$/',
        );
        $messsages = array(
            'newpassword.regex' => 'Password should be include 6 charaters, alphabets, numbers and special characters',
            'confirmpassword.regex' => 'Password should be include 6 charaters, alphabets, numbers and special characters'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'status' => 0], 400);
        } else {
            $user_id = $auth['id'];
            $user = User::findOrFail($user_id);

            if ($request->input('newpassword') == $request->input('confirmpassword')) {

                $user->fill([

                    'password' => Hash::make($request->input('newpassword'))

                ])->save();

                return response()->json(['success_msg' => trans('messages.updatedSuccessfully'), 'status' => 1, 'data' => array()], 200);
            } else {
                return response()->json(['error_msg' => trans('messages.errormsg'), 'status' => 0, 'data' => array()], 400);
            }
        }
    }
}
