<?php

namespace App\Helpers;

use URL;
use App\Models\Contact;
use App\Models\ParentPayment;
use App\Models\SupportTicket;
use App\Models\TutorForm;

class TutorFormHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        $insert = new TutorForm($data);
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
        $update = TutorForm::where($where)->update($data);
        return $update;
    }
    public static function getPaidListwithPaginate($name,$created_date, $tutorName, $tutionDay){
        $query = ParentPayment::where('tutor_payment_status', 'Success')->whereNull('deleted_at')->with('parentDetail')->with('parentDetail.tutorDetails')->with('parentDetail.subjectDetails')->with('parentDetail.levelDetails')->with('userDetails')
        ->whereHas('userDetails', function ($query) use ($name) {
            if($name !=''){
                $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", [$name]);
            }
        })
        ->whereHas('parentDetail.tutorDetails', function ($queryTutor) use ($tutorName) {
            if ($tutorName != '') {
                $queryTutor->whereRaw('LOWER(first_name) LIKE "%' . strtolower($tutorName) . '%"');
            }
        })
        ->whereHas('parentDetail', function ($queryDay) use ($tutionDay) {
            if ($tutionDay != '') {
                $queryDay->whereRaw('LOWER(tuition_day) LIKE "%' . strtolower($tutionDay) . '%"');
            }
        });
        
 
        if($created_date !=''){
            $explode = explode('-',$created_date);
            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($explode[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($explode[1])));
        }
        $query = $query->orderBy('id','desc')->paginate(10);
        return $query;
    }
    public static function getListwithPaginate($request)
    {
        $query = TutorForm::orderBy('id', 'desc');
        if ($request->tutor_name != '') {
            $query->where('tutor_name', 'LIKE', '%' . $request->tutor_name . '%');
        }
        if ($request->student_name != '') {
            $query->where('student_name', 'LIKE', '%' . $request->student_name . '%');
        }
        if ($request->tuition_day != '') {
            $query->where('day_of_tution', 'LIKE', '%' . $request->tuition_day . '%');
        }
        if ($request->rate != '') {
            $query->where('rate', 'LIKE', '%' . $request->rate . '%');
        }
        if ($request->commission != '') {
            $query->where('commission', 'LIKE', '%' . $request->commission . '%');
        }
        if ($request->month != '') {
            $query->where('month', 'LIKE', '%' . $request->month . '%');
        }
        // if ($request->created_date != '') {
        //     $explode = explode('-', $request->created_date);
        //     $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($explode[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime($explode[1])));
        // }
        $query = $query->paginate(10);
        return $query;
    }
}
