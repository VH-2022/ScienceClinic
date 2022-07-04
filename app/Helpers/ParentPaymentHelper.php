<?php

namespace App\Helpers;

use URL;
use App\Models\Contact;
use App\Models\ParentPayment;
use App\Models\SupportTicket;

class ParentPaymentHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        $insert = new ParentPayment($data);
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
        $update = ParentPayment::where($where)->update($data);
        return $update;
    }
    public static function getPaidListwithPaginate($name,$created_date){

        $query = ParentPayment::where('tutor_payment_status', 'Success')->whereNull('deleted_at')->with('parentDetail')->with('parentDetail.tutorDetails')->with('parentDetail.subjectDetails')->with('parentDetail.levelDetails')->with('userDetails')->whereHas('userDetails', function ($query) use ($name) {
            if($name !=''){
                $query->whereRaw('LOWER(first_name) LIKE "%'.strtolower($name).'%"');
            }
        });
        
 
        if($created_date !=''){
            $explode = explode('-',$created_date);
            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($explode[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($explode[1])));
        }
        $query = $query->orderBy('id','desc')->paginate(10);
        return $query;
    }

    public static function getUnPaidListwithPaginate($name, $created_date)
    {

        $query = ParentPayment::where('tutor_payment_status', 'Pending')->whereNull('deleted_at')->with('parentDetail')->with('parentDetail.tutorDetails')->with('parentDetail.subjectDetails')->with('parentDetail.levelDetails')->with('userDetails')->whereHas('userDetails', function ($query) use ($name) {
            if ($name != '') {
                $query->whereRaw('LOWER(first_name) LIKE "%' . strtolower($name) . '%"');
            }
        });
        if ($created_date != '') {
            $explode = explode('-', $created_date);
            $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($explode[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime($explode[1])));
        }
        $query = $query->orderBy('id', 'desc')->paginate(10);
        return $query;
    }
    public static function getListwithPaginate($name, $created_date)
    {

        $query = ParentPayment::whereNull('deleted_at')->with('parentDetail')->with('parentDetail.tutorDetails')->with('parentDetail.subjectDetails')->with('parentDetail.levelDetails')->with('userDetails')->whereHas('userDetails', function ($query) use ($name) {
            if ($name != '') {
                $query->whereRaw('LOWER(first_name) LIKE "%' . strtolower($name) . '%"');
            }
        });


        if ($created_date != '') {
            $explode = explode('-', $created_date);
            $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($explode[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime($explode[1])));
        }
        $query = $query->orderBy('id', 'desc')->paginate(10);
        return $query;
    }
}
