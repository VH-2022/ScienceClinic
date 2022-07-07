<?php



namespace App\Helpers;

use App\Models\ApiAccessToken;

class ApiAccessTokenHelper

{
    public static function save($data, $id)

    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['created_by'] = $userId['id'];
            $data['user_id'] = $id;
        }
        $insert = new ApiAccessToken($data);
        $insert->save();
        $insertId = $insert->id;
        return $insertId;
    }
    public static function getDetails($id)
    {
        $data = ApiAccessToken::select('access_token')->where('id', $id)->whereNull('deleted_at')->first();
        return $data;
    }

}
