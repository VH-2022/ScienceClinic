<?php



namespace App\Helpers;

use App\Models\Feedback;
use App\Models\TutorFeedback;

class FeedbackHelper {

    public static function save($data)

    {

        $userId = Auth()->user();

        $data['created_at'] = date('Y-m-d H:i:s');

        if ($userId) {

            $data['created_by'] = $userId['id'];
        }

        $insert = new Feedback($data);

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

        $update = Feedback::where($where)->update($data);

        return $update;
    }

    public static function getFeedbackDataById($parentId,$tutorId)
    {
        return Feedback::where('parent_id',$parentId)->where('tutor_id', $tutorId)->first();
    }
    public static function getFeedback($uniqueId)
    {
        return Feedback::where('parent_id', $uniqueId)->first();

    }
}