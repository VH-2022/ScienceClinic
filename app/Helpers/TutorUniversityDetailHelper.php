<?php



namespace App\Helpers;



use URL;

use App\Models\TutorUniversityDetail;
use Illuminate\Support\Facades\Auth;

class TutorUniversityDetailHelper

{

    public static function save($data)

    {

        $userId = Auth()->user();

        $data['created_at'] = date('Y-m-d H:i:s');

        if ($userId) {

            $data['created_by'] = $userId['id'];

        }

        $insert = new TutorUniversityDetail($data);

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

        $update = TutorUniversityDetail::where($where)->update($data);

        return $update;

    }

    public static function SoftDelete($data, $where)

    {

        $userId = Auth()->user();

        $data['deleted_at'] = date('Y-m-d H:i:s');

        $data['deleted_by'] = $userId['id'];

        $update = TutorUniversityDetail::where($where)->update($data);

        return $update;

    }

    public static function getListwithPaginate($id){

        $query = TutorUniversityDetail::whereNull('deleted_at')->where('tutor_id',$id)->get();

        return $query;

    }
    public static function getTutorUniversityDetails($id)
    {
        $query = TutorUniversityDetail::whereRaw('sha1(tutor_id)="' . $id . '"')->get();
        return $query;
    }
    public static function getUniversityData($id){
        $query = TutorUniversityDetail::select('*','id as certificateId')->where('tutor_id',$id)->get();
        return $query;
    }
    public static function updateCertificate($pdf, $id){
        $user = Auth::guard('web')->user();
        $data['updated_at'] = date('Y-m-d H:i:s');        
        $data['updated_by'] = $user['id'];
        $data['document_image'] = $pdf;
        $query = TutorUniversityDetail::where('tutor_id',$user['id'])->where('id', $id)->update($data);
        return $query;
    }

    public static function getTutorUniversityDetailsById($id)
    {
        $query = TutorUniversityDetail::where('tutor_id', $id)->get();
        return $query;
    }
    public static function deleteUniversity($id)
    {
       return TutorUniversityDetail::where('tutor_id',$id)->delete();
    }
}

