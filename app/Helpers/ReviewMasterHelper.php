<?php

namespace App\Helpers;

use App\Models\ReviewMaster;

class ReviewMasterHelper
{

    public static function save($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        
        $insert = new ReviewMaster($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }
}
