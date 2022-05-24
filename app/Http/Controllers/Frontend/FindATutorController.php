<?php

namespace App\Http\Controllers\Frontend;

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
class FindATutorController extends Controller
{
    public function index()
    {
        return view('frontend.SearchTutor.index');
    }

   
    public function getTutors(Request $request)
    {
        $final_array = array();

        if($request->subject !=''){
            
            $subjectUserList = TutorSubjectDetailHelper::getSearchUserId($request->subject);
      
        
            foreach($subjectUserList as $val){
                if(in_array($val->tutor_id, $final_array)){

                }   else{
                    $final_array[] = $val->tutor_id;
                }
            }
        }
 
        if($request->level !=''){
            $tutorUserList = TutorLevelDetailHelper::getSearchUserId($request->level);
            foreach ($tutorUserList as $vals) {
                if (in_array($vals->tutor_id, $final_array)) {
                } else {
                    $final_array[] = $vals->tutor_id;
                }
            }
        }
        
       
        $query = UserHelper::getTutorListLimitFive($final_array);
        foreach($query as $val){
            $val->url = URL::to('/').'/tutors-details/'.sha1($val->id);
        }
        return response()->json(['error_msg' => "Success", 'data' => $query], 200);
        
    }

    public function tutorDetails($id){
        
        return view('frontend.SearchTutor.view_tutor_detail');
    }
}
