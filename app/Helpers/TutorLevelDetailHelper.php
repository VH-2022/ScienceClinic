<?php

namespace App\Helpers;

use URL;
use App\Models\TutorLevelDetail;


class TutorLevelDetailHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['created_by'] = $userId['id'];
        }
        $insert = new TutorLevelDetail($data);
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
        $update = TutorLevelDetail::where($where)->update($data);
        return $update;
    }
    public static function SoftDelete($data, $where)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $data['deleted_by'] = $userId['id'];
        $update = TutorLevelDetail::where($where)->update($data);
        return $update;
    }
    public static function getListwithPaginate($id){
        $query = TutorLevelDetail::whereNull('deleted_at')->where('tutor_id',$id)->paginate(10);
        return $query;
    }
}
