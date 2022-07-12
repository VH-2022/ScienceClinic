<?php



namespace App\Helpers;

use App\Models\ParentDetail;
use Carbon\Carbon;

class ParentDetailHelper
{

    public static function save($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');

        $insert = new ParentDetail($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }
    public static function update($data, $where)

    {
        $userId = Auth()->user();
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['updated_by'] = $userId['id'];
        }
        $update = ParentDetail::where($where)->update($data);

        return $update;
    }
    public static function attendStudentlesson($id)
    {
        return ParentDetail::where('id', $id)->update(array('attend_class' => '1', 'updated_at' => date('Y-m-d H:i:s')));
    }
    public static function getMerithubStudentlesson($tutorId, $subjectId, $teachingType)
    {
        return ParentDetail::where('tutor_id', $tutorId)->where('teaching_type', $teachingType)->where('schedule_class', 0)->where('subject_id', $subjectId)->whereDate('booking_date', date('Y-m-d'))->get();
    }
    public static function getScheduledMerithubStudentlesson($tutorId, $subjectId, $teachingType)
    {
        return ParentDetail::where('tutor_id', $tutorId)->where('teaching_type', $teachingType)->where('schedule_class', 1)->where('subject_id', $subjectId)->whereDate('booking_date', date('Y-m-d'))->get();
    }
    public static function attendMerithubStudentlesson($id, $tutorId, $subjectId)
    {
        return ParentDetail::where('id', $id)->where('tutor_id', $tutorId)->where('subject_id', $subjectId)->whereDate('booking_date', date('Y-m-d'))->update(array('attend_class' => '1', 'updated_at' => date('Y-m-d H:i:s'), 'schedule_class' => 1));
    }
    public static function getBooklessondata($id)
    {
        return ParentDetail::with('tutorDetails', 'subjectDetails', 'levelDetails')->where('user_id', $id)->where('payment_status', 'Success')->get();
    }
    public static function getBooklessondataTutor($id)
    {
        return ParentDetail::with('userDetails', 'subjectDetails', 'levelDetails')->where('tutor_id', $id)->where('payment_status', 'Success')->where('booking_status', 'Success')->get();
    }
    public static function getUserDetails($id)
    {
        return ParentDetail::with('userDetails', 'subjectDetails', 'levelDetails')->find($id);
    }
    public static function getPaymenttoken($token)
    {
        return ParentDetail::where('payment_token', $token)->first();
    }
    public static function getListwithPaginate($id)
    {

        $query = ParentDetail::with(['tutorDetails', 'subjectDetails', 'levelDetails'])->whereNull('deleted_at')->where('user_id', $id)->get();
        return $query;
    }
    public static function getListwithPaginateWithParent($parentID, $id)
    {

        $query = ParentDetail::with(['tutorDetails', 'subjectDetails', 'levelDetails'])->whereNull('deleted_at')->where('user_id', $parentID)->where('tutor_id', $id)->whereDate('booking_date', '>=', date('Y-m-d'))->groupBy('subject_id')->get();
        return $query;
    }
    public static function getBookSlotData($time)
    {
        return ParentDetail::with('userDetails', 'subjectDetails')->where('tuition_time', $time)->where('booking_status', 'Success')->get();
    }

    public static function getBookSlotDataById($userId, $time)
    {
        return ParentDetail::where('tuition_time', $time)->where('id', $userId)->first();
    }
    public static function saveHours($id, $hours, $minutes, $hourly_rate, $teaching_start_time, $teaching_type)
    {
        $finalEndTime = "";
        $time = Carbon::parse($teaching_start_time);
        $endTime = $time->addHours($hours);
        $finalEndTime = $endTime;
           if($minutes != ''){
        $finalEndTime = $endTime->addMinutes($minutes);
        $hours = $hours.'.'. $minutes;
           }
        $arrData = array(
            'teaching_hours' => $hours,
            'hourly_rate' => $hourly_rate,
            'teaching_type' => $teaching_type,
            'teaching_start_time' => date("H:i:s", strtotime($teaching_start_time)),
            'teaching_end_time' => $finalEndTime
        );
        $query = ParentDetail::where('id', $id)->update($arrData);
        return $query;
    }
    public static function getAllInquiry($id)
    {
        $query = ParentDetail::whereNull('deleted_at')->where('user_id', $id)->where('payment_status', 'Success')->where('booking_status', 'Success')->groupBy('subject_id')->pluck('tutor_id')->toArray();
        return $query;
    }
    public static function getSubjectInquiry($id)
    {
        $query = ParentDetail::whereNull('deleted_at')->where('user_id', $id)->where('payment_status', 'Success')->where('booking_status', 'Success')->groupBy('subject_id')->pluck('subject_id')->toArray();
        return $query;
    }
    public static function getParentsByBookings($parentId)
    {
        return ParentDetail::with(['tutorDetails', 'userDetails', 'subjectDetails'])->where('payment_status', 'Success')->where('booking_status', 'Success')->where('user_id', $parentId)->get();
    }
    public static function getParentDetailsById($id)
    {
        return ParentDetail::where('id', $id)->first();
    }
    public static function getMissedLesson()
    {
        $query =  ParentDetail::with(['tutorDetails', 'subjectDetails'])->select('id', 'tuition_day', 'tutor_id', 'subject_id', 'attend_class', 'tutor_reject_reason', 'teaching_start_time', 'booking_date')
            ->whereHas('subjectDetails', function ($subjectQuery) {
                $subjectQuery->whereNull('deleted_at');
            })
            ->whereHas('tutorDetails', function ($queryVal) {
                $queryVal->where('status', 'Accepted');
            })
            ->where('attend_class', '0')
            ->get();
        return $query;
    }
    public static function getPaidParentListWithPaginate($id)
    {
        $query =  ParentDetail::with(['userDetails', 'tutorDetails', 'subjectDetails'])->select('id', 'user_id', 'booking_date', 'payment_status', 'subject_id', 'tutor_id')
            ->whereHas('userDetails', function ($queryVal) {
                $queryVal->where('status', 'Accepted');
            })
            ->whereHas('subjectDetails', function ($subjectQuery) {
                $subjectQuery->whereNull('deleted_at');
            })
            ->whereHas('tutorDetails', function ($tutorVal) {
                $tutorVal->where('status', 'Accepted');
            })
            ->where('user_id', $id)
            ->where('payment_status', 'Success')
            ->where('booking_status', 'Success')
            ->paginate(10);
        return $query;
    }
    public static function getParentData($id)
    {
        $query =  ParentDetail::with('userDetails')->whereHas('userDetails', function ($queryVal) {
            $queryVal->where('status', 'Accepted');
            $queryVal->whereNull('deleted_at');
            $queryVal->orderBy('id', 'desc');
        })
            ->where('tutor_id', $id)
            ->groupBy('user_id')
            ->paginate(10);
        return $query;
    }
    public static function getSubjectDetails($id, $tutorId, $subjectId)
    {
        return ParentDetail::with('subjectDetails')->where('id', $id)->where('tutor_id', $tutorId)->where('subject_id', $subjectId)->whereDate('booking_date', date('Y-m-d'))
            ->whereHas('subjectDetails', function ($subjectQuery) {
                $subjectQuery->whereNull('deleted_at');
            })
            ->first();
    }
    public static function updateResponse($subject_id, $id, $data)
    {
        $query = ParentDetail::where('subject_id', $subject_id)->where('tutor_id', $id)->whereDate('booking_date', date('Y-m-d'))->update($data);
        return $query;
    }
    public static function getFeedbackDataById($uniqueId)
    {
        return ParentDetail::with('subjectDetails')->where('id', $uniqueId)->first();
    }
}
