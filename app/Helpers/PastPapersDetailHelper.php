<?php



namespace App\Helpers;

use App\Models\PastPapers;
use App\Models\PastPapersDetail;
use URL;

use App\Models\SubjectMaster;
use App\Models\TextBooks;
use DB;

class PastPapersDetailHelper

{

    public static function save($data)

    {

        $userId = Auth()->user();

        $data['created_at'] = date('Y-m-d H:i:s');

        if ($userId) {

            $data['created_by'] = $userId['id'];

        }

        $insert = new PastPapersDetail($data);

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

        $update = PastPapersDetail::where($where)->update($data);

        return $update;

    }

    public static function SoftDelete($data, $where)

    {

        $userId = Auth()->user();

        $data['deleted_at'] = date('Y-m-d H:i:s');

        $data['deleted_by'] = $userId['id'];

        $update = PastPapersDetail::where($where)->update($data);

        

        return $update;

    }

    public static function getListwithPaginate($title,$created_date){

        $query = PastPapersDetail::whereNull('deleted_at');

                if($title !=""){

                    $query->where('text_book_title','LIKE','%'.$title.'%');

                }

                if($created_date !=""){

                    $explode = explode('-',$created_date);

                    $query->whereDate('created_at','>=',date('Y-m-d',strtotime($explode[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($explode[1])));

                }
        $query = $query->paginate(50);
        return $query;
    }
    public static function getDetailsByid($id){
        $query = PastPapersDetail::where('paper_id',$id)->whereNull('deleted_at')->get();
        return $query;
    }
    public static function getAllsubject(){
        return SubjectMaster::whereNull('deleted_at')->get();
    }
    public static function getAlldataByPaperSchemaID($id){
        return PastPapersDetail::where('paper_id',$id)->whereNull('deleted_at')->get();
    }
}