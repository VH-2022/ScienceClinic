<?php
namespace App\Helpers;

use URL;
use App\Models\User;
use DB;

class TutorMasterHelper
{
    public static function getListwithPaginate(){

        $query = User::whereNotNull('id')->where('type',2)->paginate(10);
        return $query;
    }
    public static function SoftDelete($data, $where)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $data['deleted_by'] = $userId['id'];
        $update = User::where($where)->update($data);
        return $update;
    }

    public static function getDetailsById($id){
        $query = User::where('id',$id)->get();
        return $query;
    }
}