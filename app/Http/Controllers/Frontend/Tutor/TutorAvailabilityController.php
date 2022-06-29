<?php

namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\ParentDetailHelper;
use App\Helpers\TutorAvailabilityHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TutorAvailabilityController extends Controller
{
    public function index()
    {
        return view('frontend.tutor.tutor_booking');
    }
    public function tutorAvailability()
    {
        return view('frontend.tutor.tutor_availability');
    }
    public function getTutorAvailabilityDetails()
    {
        $userId = Auth::user()->id;
        $data = TutorAvailabilityHelper::getData($userId);
        return response()->json($data);
    }
    public function addTutorAvailability(Request $request)
    {

        $data = explode("T", $request->date);
        $dateTime[] = $data[0];
        $data1 = explode("+", $data[1]);
        $dateTime[] = $data1[0];
        $finalDateTime = implode(" ", $dateTime);

        $finalArr = array(
            'tutor_id' => $request->tutor_id,
            'available_datetime' => $finalDateTime,
        );
        $userData = TutorAvailabilityHelper::save($finalArr);

        if ($userData) {
            return response()->json(['error_msg' => "Successfully Updated", 'data' => $userData], 200);
        } else {
            return response()->json(['error_msg' => "Something Went Wrong", 'data' => ''], 400);
        }
    }

    public function getBookedSlotData(Request $request)
    {

        $parentData = ParentDetailHelper::getBookSlotData($request->subject_id, $request->user_id);
        return response()->json($parentData);
    }

    public function showBookedslots($userId, $time)
    {

        $parentData['bookslots'] = ParentDetailHelper::getBookSlotData($time);
        return view('frontend.tutor.tutor_booked_slot_details', $parentData);
    }

    public function editBookSlot(Request $request)
    {
        $data = ParentDetailHelper::getBookSlotDataById($request->id, $request->time);
        return response()->json($data);
    }
    public function updateBookSlot(Request $request)
    {
        $rules = array(
            'time' => 'required',

            'day' => 'required',

        );
        $validator = Validator::make($request->all(), $rules);

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

            $dataArr = array(
                'tuition_day' => $request->day,
                'tuition_time' => $request->time,
                'booking_date' => $bookDate,
            );

            $data = ParentDetailHelper::update($dataArr, array('id' => $request->id));
            if ($data) {
                return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'status' => 0, 'data' => array($dataArr)], 200);
            } else {
                return response()->json(['error_msg' => "", 'status' => 1, 'data' => array()], 400);
            }
        }
    }

    public function cancelSlot(Request $request)
    {
        $update = ParentDetailHelper::update(array('booking_status' => 'Cancelled'), array('id' => $request->userId));
        if($update){
            return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'status' => 1, 'data' => array()], 200);
        }else{
            return response()->json(['error_msg' => "", 'status' => 0, 'data' => array()], 400);
        }
    }
    public function getTutorBookingsDetails(Request $request)
    {
        $userId = Auth::user()->id;
        $data = ParentDetailHelper::getBooklessondataTutor($userId);

        return response()->json($data);
    }
}
