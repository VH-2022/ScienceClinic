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
        $query = TutorResources::where('user_id',$id)->whereNull('deleted_at')->paginate(10);
        return $query;
    }
    public static function getListwithPaginateAdmin($id){
        $query = TutorResources::whereNull('deleted_at')->paginate(10);
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