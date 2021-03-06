<?php

namespace App\Helpers;

use URL;
use App\Models\User;
use DB;

class UserHelper
{
    public static function save($data)
    {
        $userId = Auth()->user();
        $data['created_at'] = date('Y-m-d H:i:s');
        if ($userId) {
            $data['created_by'] = $userId['id'];
        }
        $insert = new User($data);
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
    public static function SoftDelete($data, $where)
    {
        $userId = Auth()->user();
        $data['deleted_at'] = date('Y-m-d H:i:s');
        $data['deleted_by'] = $userId['id'];
        $update = User::where($where)->update($data);
        return $update;
    }
    public static function getUserDetails($id)
    {
        $query  = User::where('id', $id)->first();
        return $query;
    }
    public static function checkDuplicateEmail($email)
    {
        $query  = User::where('status', '1')->where('email', $email)->count();
        return $query;
    }
}
