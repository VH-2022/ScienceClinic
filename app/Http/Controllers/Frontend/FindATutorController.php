<?php



namespace App\Http\Controllers\Frontend;

use App\Helpers\ParentDetailHelper;
use App\Helpers\ReviewMasterHelper;
use App\Helpers\SubjectHelper;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\SubjectMaster;

use App\Models\TutorDetail;

use App\Models\TutorLevel;

use App\Helpers\TutorSubjectDetailHelper;

use App\Helpers\TutorLevelDetailHelper;

use App\Helpers\UserHelper;

use App\Models\User;

use URL;
use App\Helpers\TutorDetailHelper;
use App\Helpers\TutorLevelHelper;
use App\Helpers\TutorUniversityDetailHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FindATutorController extends Controller

{

    public function index()

    {

        return view('frontend.SearchTutor.index');
    }





    public function getTutors(Request $request)

    {

        $final_array = array();



        $subjectUserList = TutorLevelDetailHelper::getSearchUserId($request->subject, $request->level);

        foreach ($subjectUserList as $val) {

            if (in_array($val->tutor_id, $final_array)) {
            } else {

                $final_array[] = $val->tutor_id;
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

        $tutorSubjectLevelDetails = TutorLevelDetailHelper::getTutorLevelDetails($id);

        foreach ($tutorSubjectLevelDetails as $val) {
            $query = TutorLevelDetailHelper::getAllLevelDetials($val->subject_id, $id);
            $val->level_details = $query;
        }

        $data['tutorSubjectLevelDetails'] = $tutorSubjectLevelDetails;
        $data['tutorDetails'] = TutorDetailHelper::getTutorDetails($id);
        $data['tutorUniversityDetails'] = TutorUniversityDetailHelper::getTutorUniversityDetails($id);
        $data['subject_list'] = SubjectHelper::getAllSubjectList();

        $data['tutor_level_list'] = TutorLevelHelper::getAllTutorList();

        return view('frontend.SearchTutor.view_tutor_detail', $data);
    }
    public function saveReview(Request $request)
    {
        $data = array(
            'tutor_id' => $request->id,
            'descriptions' => $request->description,
            'subject' => $request->subject,
            'outcome' => $request->outcome,
            'rating' => $request->rating,
        );
        ReviewMasterHelper::save($data);

        return response()->json(['error_msg' => "Success", 'data' => $data], 200);
    }

    public function saveInquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'first_name' => 'required',

            'last_name' => 'required',

            'email' => 'required',

            'phone' => 'required',

            'subjectinquiry' => 'required',

            'level' => 'required',

            'days' => 'required',

            'tuition_time' => 'required',

            'address' => 'required',

            'username' => 'required',

            'password' => 'required',

        ]);

        if ($validator->fails()) {

            return redirect("/find-tutor")

                ->withErrors($validator, 'useredit')

                ->withInput();
        } else {

            $userArr = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'type' => 3,
                'email' => $request->email,
                'mobile_id' => $request->phone,
                'address1' => $request->address,
                'user_name' => $request->username,
                'password' => Hash::make($request->password),

            );
            $save = UserHelper::save($userArr);
            if($save){
                $inquiryArr = array(
                    'user_id' => $save,
                    'subject_id' => $request->subjectinquiry,
                    'level_id' => $request->level,
                    'tuition_day' => $request->days,
                    'tuition_time' => $request->tuition_time,
                );
                ParentDetailHelper::save($inquiryArr);
                return response()->json(['error_msg' => "Successfully instered", 'data' => $userArr], 200);
            }else{

            }
            
        }
    }
}
