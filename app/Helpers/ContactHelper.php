<?php

namespace App\Helpers;

use URL;
use App\Models\Contact;


class ContactHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        $insert = new Contact($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }  
    
    public static function getListwithPaginate($name,$phone_no,$tutor_type,$email,$created_date){

        $query = Contact::whereNull('deleted_at');
        if($name !=''){
            $query->where('name','LIKE','%'.$name.'%');
        }
        if($phone_no !=''){
            $query->where('phone_no','LIKE','%'.$phone_no.'%');
        }
        if($tutor_type !=''){
            $query->where('tutor_type','LIKE','%'.$tutor_type.'%');
        }
        if($email !=''){
            $query->where('email','LIKE','%'.$email.'%');
        }
        if($created_date !=''){
            $explode = explode('-',$created_date);
            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($explode[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($explode[1])));
        }
        $query = $query->orderBy('id','desc')->paginate(10);
        return $query;
    }
}
