<?php



namespace App\Helpers;

use App\Models\TutorBankAccountDetails;
use Illuminate\Support\Facades\Auth;

class TutorBankAccountDetailsHelper

{
    public static function save($data)

    {

        $userId = Auth()->user();

        $data['created_at'] = date('Y-m-d H:i:s');

        if ($userId) {

            $data['created_by'] = $userId['id'];
        }

        $insert = new TutorBankAccountDetails($data);

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

        $update = TutorBankAccountDetails::where($where)->update($data);

        return $update;
    }

    public static function getTutors($id)
    {
       return TutorBankAccountDetails::where('tutor_id',$id)->first();
    }

   

}