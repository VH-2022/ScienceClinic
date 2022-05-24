<?php



namespace App\Helpers;

use App\Models\TutorLevel;
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

    public static function getSearchUserId($search,$level)

    {


        $query = TutorLevelDetail::select('sc_tutor_level_details.tutor_id')->leftjoin('sc_subject_master as sb', function ($join) {
            $join->on('sb.id', '=', 'sc_tutor_level_details.subject_id');
        })->leftjoin('sc_tutor_level as level', function ($join) {
            $join->on('level.id', '=', 'sc_tutor_level_details.level_id');
        });
        if($search !=''){
            $query->whereRaw('LOWER(sb.main_title) LIKE "%'.strtolower($search).'%"');
        }
        if ($level != '') {
            $query->whereRaw('LOWER(level.title) LIKE "%' . strtolower($level) . '%"');
        }
        $query = $query->groupBy('sc_tutor_level_details.tutor_id')->get();
        return $query;
        

    }
    public static function getTutorLevelDetails($id)
    {
        $query = TutorLevelDetail::select('sc_tutor_level_details.*','sb.main_title')->leftjoin('sc_subject_master as sb', function ($join) {
            $join->on('sb.id', '=', 'sc_tutor_level_details.subject_id');
        })->whereRaw('sha1(sc_tutor_level_details.tutor_id)="' . $id . '"')->groupBy('sc_tutor_level_details.subject_id')->orderBy('sb.main_title', 'asc')->get();
        return $query;
       

    }

    public static function getAllLevelDetials($subjectId ,$id){
        $query = TutorLevelDetail::select('level.title')->leftjoin('sc_tutor_level as level',function($join){
            $join->on('level.id','=', 'sc_tutor_level_details.level_id');
            
        })->whereRaw('sc_tutor_level_details.subject_id="' . $subjectId . '"')
        ->whereRaw('sha1(sc_tutor_level_details.tutor_id)="' . $id . '"')
        ->get();
        
        return $query;
    }

   
}

