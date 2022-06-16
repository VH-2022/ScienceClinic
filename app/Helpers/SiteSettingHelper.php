<?php

namespace App\Helpers;

use URL;
use App\Models\Contact;
use App\Models\SiteSetting;
use App\Models\SupportTicket;

class SiteSettingHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        $insert = new SiteSetting($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }  
    public static function getSettingdata(){
        return SiteSetting::find(1);
    }
    public static function update($data, $where)
    {
        $userId = Auth()->user();
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['updated_by'] = $userId['id'];
        }
        $update = SiteSetting::where($where)->update($data);
        return $update;
    }
    
}
