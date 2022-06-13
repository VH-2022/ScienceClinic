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

}
