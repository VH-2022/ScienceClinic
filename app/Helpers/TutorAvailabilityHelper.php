<?php



namespace App\Helpers;

use App\Models\TutorAvailability;


class TutorAvailabilityHelper

{

    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['created_by'] = $userId['id'];
        }
        $insert = new TutorAvailability($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }

    public static function getData($id)
    {
       $query = TutorAvailability::where('tutor_id',$id)->whereNull('deleted_at')->get();
       return $query;
    }
    public static function checkAvalibility($tutorId, $dayTime)
    {
       $query = TutorAvailability::where('tutor_id',$tutorId)->whereNull('deleted_at')->where('available_datetime', $dayTime)->first();
       return $query;
    }

}
