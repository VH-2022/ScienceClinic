<?php

namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageUploadTrait;

class TutorProfilePhotoController extends Controller
{
    use ImageUploadTrait;
    
    public function index()
    {
        return view('frontend.tutor.tutor_profile_photo');
    }

    public function updateTutorImage(Request $request)
    {
       
        $image = '';
        if ($request->file('profile') != '') {
            $image = $this->uploadImageWithCompress($request->file('profile'), 'uploads/user');
        }
        $data = UserHelper::updateProfile($image);
        if ($data) {
            return response()->json(['success_msg' => trans('messages.updatedSuccessfully'), "data" => $image], 200);
        } else {
            return response()->json(['error_msg' => trans('messages.error'), "data" => ''], 400);
        }
    }
}
