<?php

namespace App\Helpers;

use URL;
use App\Models\Contact;
use App\Models\SupportTicket;

class SupportTicketHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        $insert = new SupportTicket($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }  
    
    public static function getListwithPaginate($user_type,$created_date){

        $query = SupportTicket::whereNull('deleted_at')->whereHas('userDetails', function ($query) use ($user_type) {
            if($user_type !=''){
                $query->where('type',$user_type);
            }
        });
        
 
        if($created_date !=''){
            $explode = explode('-',$created_date);
            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($explode[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($explode[1])));
        }
        $query = $query->orderBy('id','desc')->paginate(10);
        return $query;
    }
}
