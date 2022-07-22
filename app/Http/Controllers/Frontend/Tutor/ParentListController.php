<?php

namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\ApiAccessTokenHelper;
use App\Helpers\OnlineTutoringHelper;
use App\Helpers\ParentDetailHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ParentListController extends Controller
{
    public function index()
    {
      $tutorId = auth::user()->id;
        $data['parentslist'] = ParentDetailHelper::getParentData($tutorId);
        return view('frontend.tutor.tutor-parent-list', $data);
    }

    public function getParentDetails($id)
    {
        $data['parentData'] = UserHelper::getParentDetailsById($id);
        return view('frontend.tutor.tutor-parent-details', $data);
    }

    public function getOnlineTutoringData()
    {
        $data = OnlineTutoringHelper::getDetails();
        return json_encode($data);
    }

    public function parentSubjectDetails(Request $request)
    {
        $tutor_id = Auth::user()->id;
        $data['query'] = ParentDetailHelper::getListwithPaginateWithParent($request->parentID, $tutor_id);
        return view('frontend.tutor.parent-subject-details', $data);
    }
    function base64url_encode($str)
    {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }
    function generate_jwt($headers, $payload, $secret = '')
    {
        $secret = env('MERITHUB_CLIENT_SECRET');
        $headers_encoded = self::base64url_encode(json_encode($headers));
        $payload_encoded = self::base64url_encode(json_encode($payload));
        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
        $signature_encoded = self::base64url_encode($signature);
        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
        return $jwt;
    }
    public function attendLesson(Request $request)
    {
        $tutor_id = Auth::user()->id;
        if ($request->teachingType == 8) {
            $getData = ParentDetailHelper::getMerithubStudentlesson($tutor_id, $request->subjectId, $request->teachingType);
            if ($getData) {
                foreach ($getData as $val) {
                    $update = ParentDetailHelper::attendMerithubStudentlesson($val->id, $val->tutor_id, $val->subject_id);
                }
                $getTutorData = UserHelper::getTutorDetailsById($tutor_id);
                $getUserId = json_decode($getTutorData->api_response);
                $userId = $getUserId->userId;
                $clientId = env('MERITHUB_CLIENT_ID');
                $timeZone = env('APP_TIMEZONE');
                $headers = array('alg' => 'HS256', 'typ' => 'JWT');
                $payload = array('aud' => 'https://serviceaccount1.meritgraph.com/v1/' . $clientId . '/api/token', 'iss' => $clientId, 'expiry' => (time() + 55));
                $jwt = self::generate_jwt($headers, $payload);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://serviceaccount1.meritgraph.com/v1/' . $clientId . '/api/token',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => 'grant_type=urn%3Aietf%3Aparams%3Aoauth%3Agrant-type%3Ajwt-bearer&assertion=' . $jwt,
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/x-www-form-urlencoded'
                    ),
                ));
                curl_setopt($curl, CURLOPT_FAILONERROR, true);
                $accessToken = curl_exec($curl);
                if (!$accessToken) {
                    echo curl_error($curl);
                }
                curl_close($curl);
                if ($accessToken) {
                    $getAccessToken = json_decode($accessToken);
                    $token['access_token'] = $getAccessToken->access_token;
                    $token['time'] = date('Y-m-d H:i:s');
                    $token['api_response'] = $accessToken;
                    $token['updated_by'] = $tutor_id;
                    $token['updated_at'] = date('Y-m-d H:i:s');
                    $dataUpdate = ApiAccessTokenHelper::update($tutor_id, $token);
                    $getBarerToken = ApiAccessTokenHelper::getTutorAccessToken($tutor_id);
                    $barerToken = $getBarerToken->access_token;
                    $getDetails = ParentDetailHelper::getSubjectDetails($request->id, $tutor_id, $request->subjectId);
                    $startTime = \Carbon\Carbon::createFromFormat('H:i:s', $getDetails->teaching_start_time);
                    $endTime = \Carbon\Carbon::createFromFormat('H:i:s', $getDetails->teaching_end_time);
                    $totalDuration = $endTime->diffInMinutes($startTime);
                    $bookingDate = date('Y-m-d', strtotime($getDetails->booking_date));
                    $teachingStartTime = date('H:i:s', strtotime($getDetails->teaching_start_time));
                    $startTimeVal = $bookingDate . 'T' . $teachingStartTime . '+01:00';
                    if ($dataUpdate) {
                        $curlClass = curl_init();
                        curl_setopt_array($curlClass, array(
                            CURLOPT_URL => 'https://class1.meritgraph.com/v1/' . $clientId . '/' . $userId,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => '{
                                "title" : "' . $getDetails->subjectDetails->main_title . '",
                                "startTime" : "' . $startTimeVal . '",
                                "recordingDownload": false,
                                "duration" : ' . $totalDuration . ',
                                "lang" : "en",
                                "timeZoneId" : "' . $timeZone . '",
                                "type" : "oneTime",
                                "access" : "private",
                                "autoRecord" : false,
                                "login" : false,
                                "layout" : "CR",
                                "status" : "up",
                                "recording" : {
                                    "record" : true,
                                    "autoRecord": false, 
                                    "recordingControl": true 
                                },
                                "participantControl" : {
                                    "write" : false,
                                    "audio" : true,
                                    "video" : false
                                }
                            }',
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json',
                                'Authorization: ' . $barerToken
                            ),
                        ));
                        curl_setopt($curlClass, CURLOPT_FAILONERROR, true);
                        $scheduledClass = curl_exec($curlClass);
                        if (!$scheduledClass) {
                            echo curl_error($curlClass);
                        }
                        curl_close($curlClass);
                        if ($scheduledClass) {
                            $getHostLink = json_decode($scheduledClass);
                            $link = 'https://merithub.com/'.$clientId.'/sessions/view/'.$getHostLink->classId.'/'.$getHostLink->commonLinks->commonParticipantLink;
                            $participantLink = $link;
                            $linkTutor = 'https://merithub.com/'.$clientId.'/sessions/view/'.$getHostLink->classId.'/'.$getHostLink->commonLinks->commonHostLink;
                            $hostLink = $linkTutor;
                            $getScheduledData = ParentDetailHelper::getScheduledMerithubStudentlesson($tutor_id, $request->subjectId, $request->teachingType);
                            foreach ($getScheduledData as $value) {
                                $apiResponse['api_response'] = $scheduledClass;
                                $apiResponse['updated_at'] = date('Y-m-d H:i:s');
                                $apiResponse['updated_by'] = $tutor_id;
                                $update = ParentDetailHelper::updateResponse($value->subject_id, $value->tutor_id, $apiResponse);
                                $getUserDetails = UserHelper::getDetailsById($value->user_id);
                                if ($getUserDetails->type == '3') {
                                    $name = $getUserDetails->first_name . ' ' . $getUserDetails->last_name;
                                    $queueData = array('email' => $getUserDetails->email, "name" => $name, "hostLink" => $participantLink);
                                    $job = (new SendEmailJob($queueData));
                                    $on = \Carbon\Carbon::now()->addMinutes(1);
                                    dispatch($job)->delay($on);
                                }
                                $getTutorDetails = UserHelper::getTutorDetailsByIdMerithub($value->tutor_id);
                                if ($getTutorDetails->type == '2') {
                                    $queueData = array('email' => $getTutorDetails->email, "name" => $getTutorDetails->first_name, "hostLink" => $hostLink);
                                    $job = (new SendEmailJob($queueData));
                                    $on = \Carbon\Carbon::now()->addMinutes(1);
                                    dispatch($job)->delay($on);
                                }
                            }
                        }
                    }
                }
                return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'data' => '', 'status' => 1], 200);
            } else {
                return response()->json(['error_msg' => trans('messages.error'), 'data' => array(), 'status' => 0], 500);
            }
        } else {
            $update = ParentDetailHelper::attendStudentlesson($request->id);
            if ($update) {
                return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'data' => $update, 'status' => 1], 200);
            } else {
                return response()->json(['error_msg' => trans('messages.error'), 'data' => array(), 'status' => 0], 500);
            }
        }
    }
    public function saveTutoringHours(Request $request)
    {

        $rules = array(
            'hours' => 'required | max:4',
            // 'hourly_rate' => 'required',
            'teaching_type' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error_msg' => $validator->errors(), 'status' => 0], 400);
        } else {
            $update = ParentDetailHelper::saveHours($request->id, $request->hours,$request->minutes, $request->teaching_start_time, $request->teaching_type);

            if ($update) {
                return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'data' => $update, 'status' => 1], 200);
            } else {

                return response()->json(['error_msg' => trans('messages.error'), 'data' => array(), 'status' => 0], 500);
            }
        }
    }
}
