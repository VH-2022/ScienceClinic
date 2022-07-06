<?php



namespace App\Helpers;

use App\Models\ApiAccessToken;

class ApiAccessTokenHelper

{
    public static function save($data)

    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['created_by'] = $userId['id'];
            $data['tutor_id'] = $userId['id'];
        }
        $insert = new ApiAccessToken($data);
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
        $update = User::where($where)->update($data);
        return $update;
    }

}
