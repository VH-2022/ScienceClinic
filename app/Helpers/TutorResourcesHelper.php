<?php



namespace App\Helpers;

use App\Models\TutorResources;

class TutorResourcesHelper
{
    public static function save($data)
    {
        $insert = new TutorResources($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }
    public static function getListWithPaginate($id){
        $query = TutorResources::where('user_id',$id)->where('view_flag',1)->whereNull('deleted_at')->paginate(10);
        return $query;
    }
    public static function getListwithPaginateAdmin($title,$created_date){
        $query = TutorResources::whereNull('deleted_at');
        if ($title != '') {
            $query->where('title', $title);
        }
        if ($created_date != '') {
            $explode = explode('-', $created_date);
            $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($explode[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime($explode[1])));
        }
        $query = $query
        ->where('view_flag', 0)
        ->paginate(10);
        return $query;
    }
    public static function getListwithPaginateTutor($id,$title,$created_date){
        $query = TutorResources::whereNull('deleted_at');
        if ($title != '') {
            $query->where('title', $title);
        }
        if ($created_date != '') {
            $explode = explode('-', $created_date);
            $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($explode[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime($explode[1])));
        }
        $query = $query
        ->where('user_id', $id)
        ->where('view_flag', 0)
        ->paginate(10);
        return $query;
    }
    public static function getListwithPaginateAdminAll(){
        $query = TutorResources::whereNull('deleted_at')->where('view_flag',0)->get();
        return $query;
    }
    public static function getData($id){
        $query = TutorResources::where('id',$id)->whereNull('deleted_at')->first();
        return $query;
    }
    public static function update($mainId, $data){
        $update = TutorResources::where('id', $mainId)->update($data);
        return $update;
    }
    public static function SoftDelete($data, $where)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $data['deleted_by'] = $userId['id'];
        $update = TutorResources::where($where)->update($data);
        return $update;

    }
    public static function getDetailsByid($id){
        return TutorResources::find($id);
    }
}