<?php

namespace App\Helpers;

use URL;
use App\Models\TutorSubjectDetail;


class TutorSubjectDetailHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['created_by'] = $userId['id'];
        }
        $insert = new TutorSubjectDetail($data);
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
        $update = TutorSubjectDetail::where($where)->update($data);
        return $update;
    }
    public static function SoftDelete($data, $where)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $data['deleted_by'] = $userId['id'];
        $update = TutorSubjectDetail::where($where)->update($data);

        return $update;
    }
   
      
    public static function getListwithPaginate($id){
        $query = TutorSubjectDetail::select('sb.main_title as subject_name','sc_tutor_subject_details.created_at')
                ->leftjoin('sc_subject_master as sb',function($join){
                    $join->on('sb.id','=','sc_tutor_subject_details.subject_id');
                })->whereNull('sc_tutor_subject_details.deleted_at')->where('sc_tutor_subject_details.tutor_id',$id)->paginate(10);
        return $query;
    }
    public static function getSearchUserId($search){
       
        $query = TutorSubjectDetail::select('tutor_id')->whereHas('subjectMasters',function($q) use ($search) {
            $q->where('main_title','LIKE','%'.$search.'%');
        })->get();
        return $query;
    }
    public static function getTutorSubjectDetails($id)
    {
        $query = TutorSubjectDetail::with('subjectMasters')->whereRaw('sha1(tutor_id)="' . $id . '"')->get();
        return $query;
    }
}
