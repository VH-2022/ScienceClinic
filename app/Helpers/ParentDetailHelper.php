<?php



namespace App\Helpers;

use App\Models\ParentDetail;

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

        $query = ParentDetail::with(['tutorDetails', 'subjectDetails', 'levelDetails'])->whereNull('deleted_at')->where('user_id', $id)
            ->groupBy('subject_id')->get();
        return $query;
    }
    public static function getListwithPaginateWithParent($parentID, $id)
    {

        $query = ParentDetail::with(['tutorDetails', 'subjectDetails', 'levelDetails'])->whereNull('deleted_at')->where('user_id', $parentID)->where('tutor_id', $id)
            ->groupBy('subject_id')->get();
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
    public static function saveHours($id, $hours, $hourly_rate, $teaching_start_time)
    {
        $arrData = array(
            'teaching_hours' => $hours,
            'hourly_rate' => $hourly_rate,
            'teaching_start_time' => date("H:i:s", strtotime($teaching_start_time)),
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
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $query =  ParentDetail::with(['tutorDetails', 'subjectDetails'])->select('id','tuition_day', 'tutor_id', 'subject_id', 'attend_class', 'tutor_reject_reason', 'teaching_start_time', 'booking_date')
        ->whereHas('subjectDetails', function ($subjectQuery) {
            $subjectQuery->whereNull('deleted_at');
        })
        ->whereHas('tutorDetails', function ($queryVal) {
            $queryVal->where('status','Accepted');
        })
        ->where('booking_date','<=',$currentDate)
        ->where('teaching_start_time','<',$currentTime)
        ->where('attend_class','0')
        ->paginate(10);
        return $query;
    }
}
