<?php



namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\SubjectHelper;
use App\Helpers\TutorLevelDetailHelper;
use App\Helpers\TutorLevelHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TutorSubjectController extends Controller

{
    public $successStatus = 200;
    public function index()
    {
        $auth = Auth::guard('web')->user();
        $id = $auth['id'];
        $data['subject'] = SubjectHelper::getList();
        $data['level'] = TutorLevelHelper::getAllTutorList();
        $data['tutorData'] = $tutorData = TutorLevelDetailHelper::getListTutor($id);
        $data['tutorLevel'] = explode(',', $tutorData->level_id);
        $data['tutorSubject'] = array($tutorData->subject_id);
        return view('frontend.tutor.tutor-subject', $data);
    }
    public function store(Request $request)
    {
        $rules = array(
            'main_subject' => 'required',
            'level' => 'required'
        );
        $messsages = array(
            'main_subject.required' => 'Please select Subject',
            'level.required' => 'Please select Level'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'status' => 0], 400);
        } else {
            $auth = Auth::guard('web')->user();
            $id = $auth['id'];
            $level = $request->input('level');
            $subject = $request->input('main_subject');
            $tutorLevelDetails = array(
                'tutor_id' => $id,
                'level_id' => $level,
                'subject_id' => $subject,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $id
            );
            $insert = TutorLevelDetailHelper::save($tutorLevelDetails);
            if($insert){
                return response()->json(['error_msg' =>trans('messages.addedSuccessfully'), 'data' => array()], 200);
            }
            else{
                return response()->json(['error_msg' =>trans('messages.error'), 'data' => array()], 500);
            }
        }
    }
}
