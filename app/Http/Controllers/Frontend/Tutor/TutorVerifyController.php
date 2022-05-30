<?php



namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\TutorDetailHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Traits\ImageUploadTrait;
use App\Models\TutorDetail;

class TutorVerifyController extends Controller

{
    use ImageUploadTrait;
    public function index(){
        $user = Auth::guard('web')->user();
        $data['query'] = $tutorData = UserHelper::getTutorData($user['id']);
        foreach($tutorData as $val){
            $id = $val->userId;
            $val->certificate = TutorUniversityDetailHelper::getUniversityData($id);
        }
        return view('frontend.tutor.tutor-verify', $data);
    }
    public function updateProfile(Request $request){
        $image = '';
        if ($request->file('profile_image') != '') {
            $image = $this->uploadImageWithCompress($request->file('profile_image'), 'uploads/user');
        }
        $data = UserHelper::updateProfile($image);
        if($data){
            return response()->json(['success_msg' => trans('messages.updatedSuccessfully'), "data" => $image], 200);
        }
        else{
            return response()->json(['error_msg' => trans('messages.error'), "data" => ''], 400);
        }
    }
    public function updateDBS(Request $request){
        $image = '';
        if ($request->file('dbs') != '') {
            $image = $this->uploadImageWithCompress($request->file('dbs'), 'uploads/user');
        }
        $data = TutorDetailHelper::updateDBS($image);
        if($data){
            return response()->json(['success_msg' => trans('messages.updatedSuccessfully'), "data" => $image], 200);
        }
        else{
            return response()->json(['error_msg' => trans('messages.error'), "data" => ''], 400);
        }
    }
    public function updateCertificate(Request $request){
        $id = $request->certificate_id;
        $pdf = '';
        if ($request->file('certificate') != '') {
            $pdf = $this->uploadImageWithCompress($request->file('certificate'), 'uploads/user/certificate');
        }
        $data = TutorUniversityDetailHelper::updateCertificate($pdf, $id);
        if($data){
            return response()->json(['success_msg' => trans('messages.updatedSuccessfully'), "data" => $pdf, "id" => $id], 200);
        }
        else{
            return response()->json(['error_msg' => trans('messages.error'), "data" => ''], 400);
        }
    }

}