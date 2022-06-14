<?php



namespace App\Helpers;



use URL;

use App\Models\User;

use DB;
use Illuminate\Support\Facades\Auth;

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

        $query  = User::whereNull('deleted_at')->where('email', $email)->count();

        return $query;
    }

    public static function updateStatus($id, $status)

    {

        $data['status'] = $status;

        $query  = User::where('id', $id)->update($data);

        return $query;
    }



    public static function getTutorListLimitFive($userId)
    {

        $query = User::where('status', 'Accepted')->where('type', 2)->whereNull('deleted_at')->whereIn('id', $userId)->orderBy('id', 'desc')->limit(5)->get();

        return $query;
    }
    public static function getTutorDetails($id)
    {
        $query = User::whereRaw('sha1(id)="' . $id . '"')->first();
        return $query;
    }
    public static function getTutorData($id)
    {
        $query = User::select('*', 'users.id as userId')
            ->leftjoin('sc_tutor_details as sb', function ($join) {
                $join->on('sb.tutor_id', '=', 'users.id');
            })
            ->where('users.id', $id)
            ->whereNull('users.deleted_at')
            ->get();
        return $query;
    }
    public static function updateProfile($image)
    {
        $user = Auth::guard('web')->user();
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['updated_by'] = $user['id'];
        $data['profile_photo'] = $image;
        $query = User::where('id', $user['id'])->update($data);
        return $query;
    }



    public static function getParentList($name, $email, $phone, $address, $status, $created_date)
    {
        $query = User::orderBy('id', 'desc')->where('type', 3)->whereNull('deleted_at');

        if ($name != '') {

            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", [$name]);
            $query->orWhere('first_name', 'LIKE', '%' . $name . '%');
            $query->orWhere('last_name', 'LIKE', '%' . $name . '%');
        }
        if ($email != '') {

            $query->where('email', 'LIKE', '%' . $email . '%');
        }
        if ($phone != '') {

            $query->where('mobile_id', 'LIKE', '%' . $phone . '%');
        }
        if ($address != '') {

            $query->where('address1', 'LIKE', '%' . $address . '%');
        }
        if ($status != '') {

            $query->where('status', 'LIKE', '%' . $status . '%');
        }

        if ($created_date != '') {

            $explode = explode('-', $created_date);

            $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($explode[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime($explode[1])));
        }

        $query = $query->paginate(10);


        return $query;
    }
    public static function getDetailsById($id)
    {

        $query = User::where('id', $id)->where('type', 3)->first();

        return $query;
    }

    public static function checkEmail($email)
    {
        $query = User::select('id')->where('email', $email)->where('type', 3)->first();

        return $query;
    }
    public static function checkDuplicateEmailTutor($email)

    {
        $user = Auth::guard('web')->user();
        $id = $user['id'];
        $query  = User::whereNull('deleted_at')->where('id', '!=', $id)->where('email', $email)->count();
        return $query;
    }

    public static function checkDuplicateEmailParent($email)
    {
        $user = Auth::guard('parent')->user();
        $id = $user['id'];
        $query  = User::whereNull('deleted_at')->where('id', '!=', $id)->where('email', $email)->count();
        return $query;
    }

    public static function getUserByEmail($email)
    {
        $query  = User::whereNull('deleted_at')->where('email', $email)->first();
        return $query;
    }
    public static function updateOTP($email, $rand)
    {
        $data['otp'] = $rand;
        $query  = User::where('email', $email)->update($data);
        return $query;
    }
    public static function getByOTP($otp)
    {
        $query  = User::where('otp', $otp)->first();
        return $query;
    }
    public static function updatePassword($otp, $data)
    {
        $query  = User::where('otp', $otp)->update($data);
        return $query;
    }
    public static function checkEmailAdmin($email)
    {
        $query  = User::whereNull('deleted_at')->where('email', $email)->where('type', 1)->count();
        return $query;
    }
    public static function getAdminByEmail($email)
    {
        $query  = User::whereNull('deleted_at')->where('email', $email)->where('type', 1)->first();
        return $query;
    }
    public static function getTutors()
    {
        $query  = User::whereNull('deleted_at')->where('type', 2)->where('status', "Accepted")->get();
        return $query;
    }
}
