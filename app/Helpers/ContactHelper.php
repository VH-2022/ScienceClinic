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
}
