<?php



namespace App\Http\Controllers\Frontend;

use App\Helpers\FeedbackHelper;
use App\Helpers\ParentDetailHelper;
use App\Helpers\ReviewMasterHelper;
use App\Helpers\SubjectHelper;
use App\Helpers\TutorAvailabilityHelper;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\SubjectMaster;

use App\Models\TutorDetail;

use App\Models\TutorLevel;

use App\Helpers\TutorSubjectDetailHelper;

use App\Helpers\TutorLevelDetailHelper;

use App\Helpers\UserHelper;
use App\Helpers\TutorSearchInquiryHelper;
use App\Models\User;

use App\Helpers\TutorDetailHelper;
use App\Helpers\TutorLevelHelper;
use App\Helpers\TutorUniversityDetailHelper;
use App\Models\ParentDetail;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
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
        TutorSearchInquiryHelper::save(array('tuition_often' => $request->input('tutor_often'), 'subject' => $request->input('sibject'), 'subject' => $request->input('subject'), 'level' => $request->input('level'), 'pincode' => $request->input('pincode')));
        $subjectUserList = TutorLevelDetailHelper::getSearchUserId($request->subject, $request->level,$request->pincode);
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
        $data['tutor_comments'] = FeedbackHelper::getAllFeedbackByTutorId($id);  
       
        return view('frontend.SearchTutor.view_tutor_detail', $data);
    }
    public function saveReview(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'description' => 'required',

            'subject' => 'required|max:30',

            'outcome' => 'required|max:30',

            'rating' => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json(['message' => $validator->errors(), 'status' => 0], 400);
        } else {
            $data = array(
                'tutor_id' => $request->id,
                'descriptions' => $request->description,
                'subject' => $request->subject,
                'outcome' => $request->outcome,
                'rating' => $request->rating,
            );
            ReviewMasterHelper::save($data);

            return response()->json(['error_msg' => "Successfully instered", 'data' => $data], 200);
        }
    }

    public function checkEmailParent(Request $request){
        
        $checkParentEmail = UserHelper::checkEmail($request->email);
        if($checkParentEmail){
            return 1;
        }else{
            return 0;
        }
    }
    public function getDatesFromRange($start, $end, $format = 'Y-m-d') { 
			
        $array = array(); 
        $interval = new DateInterval('P1D'); 
        $realEnd = new DateTime($end); 
        $realEnd->add($interval); 
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
        
        foreach($period as $date) {                  
            $array[] = $date->format($format);  
        } 
        
        
        return $array; 
    }
    public function saveInquiry(Request $request)
    {
        $count = UserHelper::checkEmail($request->email);
        if (empty($count)) {
            $rules = array(
                'first_name' => 'required| max:30',
    
                'last_name' => 'required| max:30',
    
                'email' => 'required| max:30',
    
                'phone' => 'required|max:12',
    
                'subjectinquiry' => 'required',
    
                'level' => 'required',
    
                'days' => 'required',
    
                'tuition_time' => 'required',
    
                'address' => 'required| max:255',
    
                'username' => 'required| max:30',
    
                'password' => ['required','min:6','regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@$#%&*]).*$/'],
                
            );
        }else{
            $rules = array(
                'first_name' => 'required| max:30',
    
                'last_name' => 'required| max:30',
    
                'email' => 'required| max:30',
    
                'phone' => 'required|max:12',
    
                'subjectinquiry' => 'required',
    
                'level' => 'required',
    
                'days' => 'required',
    
                'tuition_time' => 'required',
    
                'address' => 'required| max:255',
    
                'username' => 'required| max:30',
                
            );
        }
        
        $messsages = array(
            'password.regex' => 'Password should be include 6 charaters, alphabets, numbers and special characters',
           
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
          

        
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'status' => 0], 400);
        } else {
            $currdate = date("Y-m-d");
            $monday = strtotime("last monday");
			$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
			$sunday = strtotime(date("Y-m-d",$monday)." +6 days");
			$this_week_sd = date("Y-m-d",$monday);
			$this_week_ed = date("Y-m-d",$sunday);
			
			$dateRang = self::getDatesFromRange($this_week_sd,$this_week_ed);
			$dateArray = array();
			foreach($dateRang as $dkey){
				if($currdate <= $dkey){
                    $dayname = date('l',strtotime($dkey));
                    $dateArray[$dkey] = $dayname;
				}
			}

            $bookDate = date('Y-m-d', strtotime($request->days.' next week'));

            if(in_array(ucfirst($request->days),$dateArray)){
                foreach($dateArray as $key => $val){
                    if(ucfirst($request->days) == $val){
                        if($key < date('Y-m-d')) {
                            $bookDate = date('Y-m-d', strtotime($request->days.' next week'));
                        }else{
                            $bookDate = $key;
                        }
                    }
                }
            }
            
            

            

            $count = UserHelper::checkEmail($request->email);
          
            if (empty($count)) {
                $userArr = array(
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'type' => 3,
                    'email' => $request->email,
                    'mobile_id' => $request->phone,
                    'address1' => $request->address,
                    'user_name' => $request->username,
                    'status' => 'Pending',
                    'password' => Hash::make($request->password),
                );


                

                $userData = UserHelper::save($userArr);
                if ($userData) {

                    
                    $inquiryArr = array(
                        'user_id' => $userData,
                        'subject_id' => $request->subjectinquiry,
                        'level_id' => $request->level,
                        'tuition_day' => $request->days,
                        'tuition_time' => $request->tuition_time,
                        'booking_date' => $bookDate,
                        'tutor_id' => $request->tutorid,
                    );

                  

                    ParentDetailHelper::save($inquiryArr);
                    return response()->json(['error_msg' => "Successfully instered", 'data' => $userArr], 200);
                } else {
                    return response()->json(['error_msg' => "Something went wrong", 'data' => ''], 500);
                }
            } else {
                $inquiryArr = array(
                    'user_id' => $count->id,
                    'subject_id' => $request->subjectinquiry,
                    'level_id' => $request->level,
                    'tuition_day' => $request->days,
                    'tuition_time' => $request->tuition_time,
                    'booking_date' => $bookDate,
                    'tutor_id' => $request->tutorid,
                );
                
                ParentDetailHelper::save($inquiryArr);
                return response()->json(['error_msg' => "Successfully instered", 'data' => $inquiryArr], 200);
            }
        }
    }
    public function tutorAvailabilityDetails(Request $request)
    {
        
        $data = TutorAvailabilityHelper::getData($request->tutotid);
        return response()->json($data);
    }
}
