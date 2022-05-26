<?php



namespace App\Helpers;



use URL;

use App\Models\TutorDetail;





class TutorDetailHelper

{

    public static function save($data)

    {

        $userId = Auth()->user();

        $data['created_at'] = date('Y-m-d H:i:s');

        if ($userId) {

            $data['created_by'] = $userId['id'];

        }

        $insert = new TutorDetail($data);

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

        $update = TutorDetail::where($where)->update($data);

        return $update;

    }

    public static function SoftDelete($data, $where)

    {

        $userId = Auth()->user();

        $data['deleted_at'] = date('Y-m-d H:i:s');

        $data['deleted_by'] = $userId['id'];

        $update = TutorDetail::where($where)->update($data);



        return $update;

    }
    public static function getTutorDetails($id)
    {
        $query = TutorDetail::whereRaw('sha1(tutor_id)="' . $id . '"')->first();
        return $query;
    }
   
    public static function getOtherListwithPaginate($id){

        $query = TutorDetail::where('tutor_id',$id)->paginate(10);
        return $query;

    }
}

