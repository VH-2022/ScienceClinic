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
        $update = SubjectMaster::where($where)->update($data);
        
        return $update;
    }
    public static function getListwithPaginate($title,$created_date){
        $query = SubjectMaster::whereNull('sc_subject_master.parent_id');
                if($title !=""){
                    $query->where('main_title','LIKE','%'.$title.'%');
                }
                if($created_date !=""){
                    $explode = explode('-',$created_date);
                    $query->whereDate('created_at','>=',date('Y-m-d',strtotime($explode[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($explode[1])));
                }
        $query = $query->paginate(50);
        return $query;
    }
    public static function getDetailsByid($id){
        $query = SubjectMaster::where('id',$id)->first();
        return $query;
    }
    public static function getList(){
        $query = SubjectMaster::whereNull('parent_id')->get();
        return $query;
    }
    public static function getSubCateogryListwithPaginate(){
        $query = SubjectMaster::select('sc_subject_master.*','scb.main_title as mtitle')
                ->leftjoin('sc_subject_master as scb',function($join){
                    $join->on('scb.id','=','sc_subject_master.parent_id');
                })->whereNotNull('sc_subject_master.parent_id')->paginate();
        
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

    public static function getAllSubjectList(){
        $query = SubjectMaster::whereNull('deleted_at')->orderBy('main_title','asc')->get();
        return $query;
    }
}

