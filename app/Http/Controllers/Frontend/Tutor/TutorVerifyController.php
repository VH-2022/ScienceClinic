<?php



namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\TutorDetailHelper;
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
        $data['query'] = UserHelper::getTutorData($user['id']);
        $data['document'] = UserHelper::getTutorData($user['id']);
        return view('frontend.tutor.tutor-verify', $data);
    }
    public function updateProfile(Request $request){
        $image = '';
        if ($request->file('profile_image') != '') {
            $image = $this->uploadImageWithCompress($request->file('profile_image'), 'uploads/user');
        }
        $data = UserHelper::updateProfile($image);
        if($data){
            return response()->json(['success_msg' => "Successfully updated", "data" => $image], 200);
        }
        else{
            return response()->json(['error_msg' => "Something went wrong"], 400);
        }
    }
    public function updateDBS(Request $request){
        $image = '';
        if ($request->file('dbs') != '') {
            $image = $this->uploadImageWithCompress($request->file('dbs'), 'uploads/user');
        }
        $data = TutorDetailHelper::updateDBS($image);
        if($data){
            return response()->json(['success_msg' => "Successfully updated"], 200);
        }
        else{
            return response()->json(['error_msg' => "Something went wrong"], 400);
        }
    }

}