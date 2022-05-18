<?php

namespace App\Helpers;

use URL;
use App\Models\SubjectMaster;
use DB;

class SubjectHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['created_by'] = $userId['id'];
        }
        $insert = new SubjectMaster($data);
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
        $update = SubjectMaster::where($where)->update($data);
        return $update;
    }
    public static function SoftDelete($data, $where)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $data['deleted_by'] = $userId['id'];
        $update = SubjectMaster::where($where)->delete();
        
        return $update;
    }
    public static function getListwithPaginate(){
        $query = SubjectMaster::whereNotNull('id')->whereNull('sc_subject_master.parent_id')->paginate(1);
        return $query;
    }
    public static function getDetailsByid($id){
        $query = SubjectMaster::where('id',$id)->first();
        return $query;
    }
    public static function getList(){
        $query = SubjectMaster::get();
        return $query;
    }
    public static function getSubCateogryListwithPaginate(){
        $query = SubjectMaster::whereNotNull('id')->whereNotNull('parent_id')->with('subjectmaster:id,parent_id,main_title')->paginate(10);
        return $query;
    }

    public static function getSubjectList(){
        $query = SubjectMaster::whereNull('parent_id')->get();
        return $query;
    }
    public static function getParentList($id){
        $query = SubjectMaster::where('parent_id',$id)->get();
        return $query;
    }

    public static function getDetailsByEncryptId($id){
        $query = SubjectMaster::whereRaw('sha1(id)="'.$id.'"')->first();
        return $query;
    }
}

