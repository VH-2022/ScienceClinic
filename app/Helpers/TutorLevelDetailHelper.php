<?php

namespace App\Helpers;

use App\Models\SubjectMaster;
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
        $query = TutorLevelDetail::with('tutorLevelRelation')->where('tutor_id',$id)->paginate(10);
        
        return $query;
    }
    public static function getSearchUserId($search)
    {

        $query = TutorLevelDetail::select('tutor_id')->whereHas('tutorLevelRelation', function ($q) use ($search) {
            $q->where('title', 'LIKE', '%' . $search . '%');
        })->get();
        return $query;
    }

    public static function getTutorLevelDetails($id)
    {
        $query = TutorLevelDetail::with('level')->whereRaw('sha1(tutor_id)="' . $id . '"')->get();
        return $query;
    }

    
}
