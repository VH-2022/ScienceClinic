<?php



namespace App\Helpers;

use App\Models\PastPapers;
use App\Models\PastPapersCategory;
use URL;

use App\Models\SubjectMaster;
use App\Models\TextBooks;
use DB;

class PastPapersHelper

{

    public static function save($data)

    {

        $userId = Auth()->user();

        $data['created_at'] = date('Y-m-d H:i:s');

        if ($userId) {

            $data['created_by'] = $userId['id'];

        }

        $insert = new PastPapers($data);

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

        $update = PastPapers::where($where)->update($data);

        return $update;

    }

    public static function SoftDelete($data, $where)

    {

        $userId = Auth()->user();

        $data['deleted_at'] = date('Y-m-d H:i:s');

        $data['deleted_by'] = $userId['id'];

        $update = PastPapers::where($where)->update($data);

        

        return $update;

    }

    public static function getListwithPaginate($title,$created_date){

        $query = PastPapers::whereNull('deleted_at');

                if($title !=""){

                    $query->where('paper_title','LIKE','%'.$title.'%');

                }

                if($created_date !=""){

                    $explode = explode('-',$created_date);

                    $query->whereDate('created_at','>=',date('Y-m-d',strtotime($explode[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($explode[1])));

                }
        $query = $query->paginate(10);
        return $query;
    }
    public static function getListwithPaginateTutor($id,$title,$created_date){

        $query = PastPapers::whereNull('deleted_at');

                if($title !=""){

                    $query->where('paper_title','LIKE','%'.$title.'%');

                }

                if($created_date !=""){

                    $explode = explode('-',$created_date);

                    $query->whereDate('created_at','>=',date('Y-m-d',strtotime($explode[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($explode[1])));

                }
        $query = $query
        ->where('created_by', $id)
        ->paginate(10);
        return $query;
    }
    public static function getDetailsByid($id){
        $query = PastPapers::where('id',$id)->first();
        return $query;
    }
    public static function getAllsubject(){
        return SubjectMaster::whereNull('deleted_at')->get();
    }
    public static function getAllcategory(){
        return PastPapersCategory::whereNull('deleted_at')->get();
    }
    public static function getDatabyCategory($id){
        return PastPapers::where('paper_category_id',$id)->whereNull('deleted_at')->get();
    }

    public static function getSubejctData($id,$subid){
        return PastPapers::where('paper_category_id',$subid)->where('id',$id)->with('subjectData')->whereNull('deleted_at')->get();
    }

    public static function getAlldataByPaperID($id){
        return PastPapers::where('id',$id)->with('subjectData')->groupBy('paper_category_id')->whereNull('deleted_at')->get();
    }
    
    
    
}