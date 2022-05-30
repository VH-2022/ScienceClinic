<?php
namespace App\Helpers;

use URL;
use App\Models\About;

class AboutHelper
{
    public static function getListwithPaginate($type,$content1,$content2,$created_date){

        $query = About::orderBy('id','desc');
        if($type !=''){
            $query->where('type','LIKE','%'.$type.'%');
        }
        if($content1 !=''){
            $query->where('content1','LIKE','%'.$content1.'%');
        }
        if($content2 !=''){
            $query->where('content2','LIKE','%'.$content2.'%');
        }

        if($created_date !=''){
            $explode = explode('-',$created_date);
            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($explode[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($explode[1])));
        }
        $query = $query->paginate(10);
        return $query;
    }

    public static function getDetailsById($id){
        $query = About::where('id',$id)->first();
        return $query;
    }

    public static function update($data, $where)
    {
        $userId = Auth()->user();
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['updated_by'] = $userId['id'];
        }
        $update = About::where($where)->update($data);
        return $update;
    }
}