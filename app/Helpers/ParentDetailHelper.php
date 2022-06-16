<?php



namespace App\Helpers;

use App\Models\ParentDetail;

class ParentDetailHelper {

    public static function save($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');

        $insert = new ParentDetail($data);
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
        $update = ParentDetail::where($where)->update($data);

        return $update;

    }
    public static function getBooklessondata($id){
        return ParentDetail::with('tutorDetails','subjectDetails','levelDetails')->where('user_id',$id)->where('payment_status','Success')->get();
    }
    public static function getUserDetails($id){
        return ParentDetail::with('userDetails','subjectDetails','levelDetails')->find($id);
    }
    public static function getPaymenttoken($token){
        return ParentDetail::where('payment_token',$token)->first();
    }
    public static function getListwithPaginate($id)
    {

        $query = ParentDetail::with(['tutorDetails', 'subjectDetails', 'levelDetails'])->whereNull('deleted_at')->where('user_id', $id)
        ->groupBy('subject_id')->get();
        return $query;
    }
}