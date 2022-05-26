<?php

namespace App\Helpers;

use URL;
use App\Models\TutorSearchInquiry;


class TutorSearchInquiryHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['created_by'] = $userId['id'];
        }
        $insert = new TutorSearchInquiry($data);
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
        $update = TutorSearchInquiry::where($where)->update($data);
        return $update;
    }
    public static function SoftDelete($data, $where)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $data['deleted_by'] = $userId['id'];
        $update = TutorSearchInquiry::where($where)->update($data);

        return $update;
    }
    public static function getListwithPaginate($subject, $postcode, $often, $level, $created_date)
    {

        $query = TutorSearchInquiry::orderBy('id', 'desc');

        if ($subject != '') {

            $query->where('subject', 'LIKE', '%' . $subject . '%');
        }
        if ($postcode != '') {

            $query->where('pincode', 'LIKE', '%' . $postcode . '%');
        }
        if ($often != '') {

            $query->where('tuition_often', 'LIKE', '%' . $often . '%');
        }
        if ($level != '') {

            $query->where('level', 'LIKE', '%' . $level . '%');
        }


        if ($created_date != '') {

            $explode = explode('-', $created_date);

            $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($explode[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime($explode[1])));
        }

        $query = $query->paginate(10);

        return $query;
    }
}
