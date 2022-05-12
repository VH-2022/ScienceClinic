<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageUploadTrait;
use App\Helpers\UserHelper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    use ImageUploadTrait;
    public $successStatus = 200;
    public function profile()
    {
        return view('admin.profile.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $auth  = auth()->user();

        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'last_name' => 'required',
            'email_id' => 'required|email',
            'mobile_id' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error_msg' => $validator->errors()->all(), 'status' => 0, 'data' => array()], $this->successStatus);
        } else {
            $simagesEnglish = '';
            if ($request->file('profile_avatar') != '') {
                $simagesEnglish = $this->uploadImageWithCompress($request->file('profile_avatar'), 'uploads/user');
            }
            $mobileo = str_replace('(', '', $request->input('mobile_id'));
            $mobileo1 = str_replace(')', '', $mobileo);
            $mobileo12 = str_replace('-', '', $mobileo1);
            $mobileNo = str_replace(' ', '', $mobileo12);
            $data_array = array(
                'first_name' => $request->input('full_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email_id'),
                'mobile_id' => $mobileNo,
            );
            if ($simagesEnglish != '') {
                $data_array['profile_photo'] = $simagesEnglish;
            }
            $update = UserHelper::update($data_array, array('id' => $auth->id));
            $query = UserHelper::getUserDetails($auth->id);
            $image = '';
            if ($query->profile_image != '') {
                $image = $query->profile_photo_path;
            }
            $query->profile_image = $image;
            return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'status' => 1, 'data' => array($query)], $this->successStatus);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkCurrentPassword(Request $request)
    {
        $auth  = auth()->user();
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error_msg' => $validator->errors()->all(), 'status' => 0, 'data' => array()], $this->successStatus);
        } else {

            $query = UserHelper::getUserDetails($request->input('users_id'));
            if (!Hash::check($request['current_password'], $query->password)) {
                return response()->json(['error_msg' => "Current password does not match", 'status' => 0, 'data' => array()], $this->successStatus);
            } else {
                return response()->json(['error_msg' => "", 'status' => 1, 'data' => array()], $this->successStatus);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PasswordUpdate(Request $request)
    {
        $auth  = auth()->user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required',
            'confirmation_password' => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json(['error_msg' => $validator->errors()->all(), 'status' => 0, 'data' => array()], $this->successStatus);
        } else {
            $id = $request->input('id');
            if ($id != '') {
                $user_id = $id;
            } else {
                $user_id = $auth['id'];
            }

            $query = UserHelper::getUserDetails($user_id);

            if (!Hash::check($request['current_password'], $query->password)) {
                return response()->json(['error_msg' => "Current password does not match", 'status' => 0, 'data' => array()], $this->successStatus);
            } else {
                $user = User::findOrFail($user_id);
                if ($request->input('new_password') == $request->input('confirmation_password')) {
                    $user->fill([
                        'password' => Hash::make($request->input('new_password'))
                    ])->save();
                    return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'status' => 1, 'data' => array()], $this->successStatus);
                } else {
                    return response()->json(['error_msg' => trans('messages.errormsg'), 'status' => 0, 'data' => array()], $this->successStatus);
                }
            }
        }
    }
}
