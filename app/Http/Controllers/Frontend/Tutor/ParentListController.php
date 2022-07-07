<?php

namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\ParentDetailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ParentListController extends Controller
{
    public function index()
    {
      $tutorId = auth::user()->id;
        $data['parentslist'] = ParentDetailHelper::getParentData($tutorId);
        return view('frontend.tutor.tutor-parent-list', $data);
    }

    public function getParentDetails($id)
    {
        $data['parentData'] = UserHelper::getParentDetailsById($id);
        return view('frontend.tutor.tutor-parent-details', $data);
    }

    public function parentSubjectDetails(Request $request)
    {
        
        $tutor_id = Auth::user()->id;
        $data['query'] = ParentDetailHelper::getListwithPaginateWithParent($request->parentID,$tutor_id);
        return view('frontend.tutor.parent-subject-details', $data);
    }

    public function attendLesson(Request $request){
        $update = ParentDetailHelper::attendStudentlesson($request->id);
        if ($update) {
            return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'data' => $update, 'status' => 1], 200);
        } else {

            return response()->json(['error_msg' => trans('messages.error'), 'data' => array(), 'status' => 0], 500);
        }
    }
    public function saveTutoringHours(Request $request)
    {

        $rules = array(
            'hours' => 'required | max:3',
            'hourly_rate' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error_msg' => $validator->errors(), 'status' => 0], 400);
        } else {
            $update = ParentDetailHelper::saveHours($request->id, $request->hours, $request->hourly_rate, $request->teaching_start_time);

            if ($update) {
                return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'data' => $update, 'status' => 1], 200);
            } else {

                return response()->json(['error_msg' => trans('messages.error'), 'data' => array(), 'status' => 0], 500);
            }
        }
    }
}
