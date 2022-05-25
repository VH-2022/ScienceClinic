<?php



namespace App\Helpers;

use App\Models\ParentInquiry;

class ParentInquiryHelper {

    public static function save($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');

        $insert = new ParentInquiry($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }
}