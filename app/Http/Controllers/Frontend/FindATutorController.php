<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\ReviewMasterHelper;
use App\Helpers\TutorDetailHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubjectMaster;
use App\Models\TutorDetail;
use App\Models\TutorLevel;
use App\Helpers\TutorSubjectDetailHelper;
use App\Helpers\TutorLevelDetailHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Helpers\UserHelper;
use App\Models\ReviewMaster;
use App\Models\TutorSubjectDetail;
use App\Models\TutorUniversityDetail;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class FindATutorController extends Controller
{
    public function index()
    {
        return view('frontend.SearchTutor.index');
    }


    public function getTutors(Request $request)
    {
        $subjectUserList = TutorSubjectDetailHelper::getSearchUserId($request->subject);
        $final_array = array();
        foreach ($subjectUserList as $val) {
            if (in_array($val->tutor_id, $final_array)) {
            } else {
                $final_array[] = $val->tutor_id;
            }
        }

        $tutorUserList = TutorLevelDetailHelper::getSearchUserId($request->input('level'));
        foreach ($tutorUserList as $vals) {
            if (in_array($vals->tutor_id, $final_array)) {
            } else {
                $final_array[] = $vals->tutor_id;
            }
        }

        $query = UserHelper::getTutorListLimitFive($final_array);
        foreach ($query as $val) {
            $val->url = URL::to('/') . '/tutors-details/' . sha1($val->id);
        }
        return response()->json(['error_msg' => "Success", 'data' => $query], 200);
    }

    public function tutorDetails($id)
    {
        $data['data'] = UserHelper::getTutorDetails($id);
        $data['tutorLevelDetails'] = TutorLevelDetailHelper::getTutorLevelDetails($id);
        $data['tutorSubjectDetails'] = TutorSubjectDetailHelper::getTutorSubjectDetails($id);
        $data['tutorDetails'] = TutorDetailHelper::getTutorDetails($id);
        $data['tutorUniversityDetails'] = TutorUniversityDetailHelper::getTutorUniversityDetails($id);

        return view('frontend.SearchTutor.view_tutor_detail', $data);
    }
    public function saveReview(Request $request)
    {
        
        $data = array(
            'tutor_id' => $request->id,
            'descriptions' =>$request->description,
            'subject' => $request->subject,
            'outcome' => $request->outcome,
            'rating' => $request->rating,
        );
         ReviewMasterHelper::save($data);

        return response()->json(['error_msg' => "Success", 'data' => $data], 200);
    }
}
