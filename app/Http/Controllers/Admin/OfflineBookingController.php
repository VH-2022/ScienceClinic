<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ParentDetailHelper;
use App\Helpers\SubjectHelper;
use App\Helpers\TutorAvailabilityHelper;
use App\Helpers\TutorLevelHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Session;

class OfflineBookingController extends Controller
{
    public function index()
    {
        $this->data['subject'] = SubjectHelper::getAllSubjectList();
        $this->data['level'] = TutorLevelHelper::getAllTutorList();
        $this->data['tutorData'] = UserHelper::getApprovedTutor();
        return view('admin.offline_bookings.index', $this->data);
    }
    public function ajaxList(Request $request)
    {
        $this->data['page'] = $request->page;
        $name = $request->name;
        $tutorName = $request->tutorName;
        $subjectName = $request->subjectName;
        $level = $request->level;
        $day = $request->day;
        $this->data['query'] = ParentDetailHelper::getOfflineBookings($name, $tutorName, $subjectName, $level, $day);
        return view('admin.offline_bookings.offline_bookings_ajax', $this->data);
    }
    public function getDatesFromRange($start, $end, $format = 'Y-m-d')
    {

        $array = array();
        $interval = new DateInterval('P1D');
        $realEnd = new DateTime($end);
        $realEnd->add($interval);
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        foreach ($period as $date) {
            $array[] = $date->format($format);
        }


        return $array;
    }
    public function storeOfflineBooking(Request $request)
    {
        $id = Auth::user()->id;
        $rules = array(
            'sname' => 'required',
            'main_subject' => 'required',
            'tutor_name' => 'required',
            'level' => 'required',
            'day' => 'required',
            'idel_time' => 'required',

        );
        $messsages = array(
            'main_subject.required' => 'Please select Subject',
            'sname.required' => 'Please enter Student Name',
            'tutor_name.required' => 'Please select Tutor',
            'level.required' => 'Please select Level',
            'day.required' => 'Please select Day',
            'idel_time.required' => 'Please Enter Idel Time'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            return redirect("/offline-bookings?addpopup=1")
                ->withErrors($validator, 'booking')
                ->withInput();
        } else {
            $hours = 1;
            $finalEndTime = "";
            $time = Carbon::parse($request->idel_time);
            $endTime = $time->addHours($hours);
            $finalEndTime = $endTime;

            $currdate = date("Y-m-d");
            $monday = strtotime("last monday");
            $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;
            $sunday = strtotime(date("Y-m-d", $monday) . " +6 days");
            $this_week_sd = date("Y-m-d", $monday);
            $this_week_ed = date("Y-m-d", $sunday);

            $dateRang = self::getDatesFromRange($this_week_sd, $this_week_ed);
            $dateArray = array();
            foreach ($dateRang as $dkey) {
                if ($currdate <= $dkey) {
                    $dayname = date('l', strtotime($dkey));
                    $dateArray[$dkey] = $dayname;
                }
            }

            $bookDate = date('Y-m-d', strtotime($request->day . ' next week'));

            if (in_array(ucfirst($request->day), $dateArray)) {
                foreach ($dateArray as $key => $val) {
                    if (ucfirst($request->day) == $val) {
                        if ($key < date('Y-m-d')) {
                            $bookDate = date('Y-m-d', strtotime($request->day . ' next week'));
                        } else {
                            $bookDate = $key;
                        }
                    }
                }
            }

            $offlineUserInquiryData = array(
                'user_id' => 0,
                'tutor_id' => $request->tutor_name,
                'subject_id' => $request->main_subject,
                'level_id' => $request->level,
                'tuition_day' => $request->day,
                'tuition_time' =>  date("H:i:s", strtotime($request->idel_time)),
                'booking_date' => $bookDate,
                'teaching_start_time' => date("H:i:s", strtotime($request->idel_time)),
                'teaching_end_time' => $finalEndTime,
                'inquiry_type' => 2,
                'user_name' => $request->sname,
                'payment_status' => "Success",
                'created_by' => $id

            );
            $saveData = ParentDetailHelper::save($offlineUserInquiryData);
            if ($saveData) {
                Session::flash('success', trans('messages.addedSuccessfully'));
                return redirect('offline-bookings');
            } else {
                Session::flash('error', trans('messages.error'));
                return redirect('offline-bookings');
            }
        }
    }
    public function checkTutorAvalibility(Request $request)
    {
        $tutorId = $request->id;
        $idelTime = date('H:i:s', strtotime($request->idelTime));
        $currdate = date("Y-m-d");
        $monday = strtotime("last monday");
        $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;
        $sunday = strtotime(date("Y-m-d", $monday) . " +6 days");
        $this_week_sd = date("Y-m-d", $monday);
        $this_week_ed = date("Y-m-d", $sunday);

        $dateRang = self::getDatesFromRange($this_week_sd, $this_week_ed);
        $dateArray = array();
        foreach ($dateRang as $dkey) {
            if ($currdate <= $dkey) {
                $dayname = date('l', strtotime($dkey));
                $dateArray[$dkey] = $dayname;
            }
        }

        $bookDate = date('Y-m-d', strtotime($request->day . ' next week'));

        if (in_array(ucfirst($request->day), $dateArray)) {
            foreach ($dateArray as $key => $val) {
                if (ucfirst($request->day) == $val) {
                    if ($key < date('Y-m-d')) {
                        $bookDate = date('Y-m-d', strtotime($request->day . ' next week'));
                    } else {
                        $bookDate = $key;
                    }
                }
            }
        }
        $dayTime = $bookDate . ' ' . $idelTime;
        $checkAvalibility = TutorAvailabilityHelper::checkAvalibility($tutorId, $dayTime);
        if($checkAvalibility){
            return 1;
        }
        else{
            return 0;
        }
    }
    public function editOfflineBooking(Request $request){
        $id = $request->id;
        $data = ParentDetailHelper::getOfflineBookingDetails($id);
        return json_encode($data);
    }
}
