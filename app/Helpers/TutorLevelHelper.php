<?php

namespace App\Helpers;

use URL;
use App\Models\TutorLevel;

class TutorLevelHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['created_by'] = $userId['id'];
        }
        $insert = new TutorLevel($data);
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
        $update = TutorLevel::where($where)->update($data);
        return $update;
    }
    public static function SoftDelete($data, $where)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $data['deleted_by'] = $userId['id'];
        $update = TutorLevel::where($where)->update($data);
        return $update;
    }
    public static function getListwithPaginate(){
        $query = TutorLevel::paginate(10);
        return $query;
    }
    public static function getDetailsById($id){
        $query = TutorLevel::where('id',$id)->first();
        return $query;
    }
}
