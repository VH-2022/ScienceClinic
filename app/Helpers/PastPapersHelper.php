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
        $query = $query->paginate(50);
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
    
}