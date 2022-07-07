<?php

namespace App\Helpers;

use URL;
use App\Models\Contact;
use App\Models\OnlineTutoring;
use App\Models\SupportTicket;

class OnlineTutoringHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        $insert = new OnlineTutoring($data);
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
        $update = OnlineTutoring::where($where)->update($data);
        return $update;
    }
    public static function getDetailsByid($id){
        return OnlineTutoring::find($id);
    }
    
    public static function SoftDelete($data, $where)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $data['deleted_by'] = $userId['id'];
        $update = OnlineTutoring::where($where)->update($data);
        return $update;

    }
    public static function getListwithPaginate($title,$created_date){
        $query = OnlineTutoring::whereNull('deleted_at');
        if($title !=""){
            $query->where('online_tutoring_name','LIKE','%'.$title.'%');
        }
        if($created_date !=''){
            $explode = explode('-',$created_date);
            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($explode[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($explode[1])));
        }
        $query = $query->orderBy('id','desc')->paginate(10);
        return $query;
    }
    public static function getDetails(){
        $query = OnlineTutoring::select('id','online_tutoring_name')->whereNull('deleted_at')->get();
        return $query;
    }
}
