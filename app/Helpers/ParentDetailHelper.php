<?php



namespace App\Helpers;

use App\Models\ParentDetail;

class ParentDetailHelper {

    public static function save($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');

        $insert = new ParentDetail($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }
    public static function getListwithPaginate($id)
    {

        $query = ParentDetail::with(['tutorDetails', 'subjectDetails', 'levelDetails'])->whereNull('deleted_at')->where('user_id', $id)
        ->groupBy('subject_id')->get();
        return $query;
    }
}