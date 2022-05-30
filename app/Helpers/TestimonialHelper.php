<?php



namespace App\Helpers;



use URL;

use App\Models\Testimonial;



class TestimonialHelper

{

    public static function save($data)

    {

        $userId = Auth()->user();

        $data['created_at'] = date('Y-m-d H:i:s');

        if ($userId) {

            $data['created_by'] = $userId['id'];

        }

        $insert = new Testimonial($data);

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

        $update = Testimonial::where($where)->update($data);

        return $update;

    }

    public static function SoftDelete($data, $where)

    {

        $userId = Auth()->user();

        $data['deleted_at'] = date('Y-m-d H:i:s');

        $data['deleted_by'] = $userId['id'];

        $update = Testimonial::where($where)->update($data);

        return $update;

    }

    public static function getListwithPaginate($author_name,$description,$created_date){

        $query = Testimonial::orderBy('id','desc');

        if($author_name !=''){

            $query->where('author_name','LIKE','%'.$author_name.'%');

        }

        if($description !=''){

            $query->where('description','LIKE','%'.$description.'%');

        }


        if($created_date !=''){

            $explode = explode('-',$created_date);

            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($explode[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($explode[1])));

        }

        $query = $query->paginate(10);

        return $query;

    }

    public static function getDetailsById($id){

        $query = Testimonial::where('id',$id)->first();

        return $query;

    }

 
}

