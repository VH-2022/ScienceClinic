<?php



namespace App\Http\Controllers\Admin;

use App\Helpers\ApiAccessTokenHelper;
use App\Helpers\MailHelper;
use App\Helpers\ParentDetailHelper;
use App\Helpers\TutorDetailHelper;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

use App\Helpers\UserHelper;

use App\Helpers\TutorMasterHelper;

use App\Helpers\TutorUniversityDetailHelper;

use App\Helpers\TutorSubjectDetailHelper;

use App\Helpers\TutorLevelDetailHelper;
use App\Models\ApiAccessToken;
use Illuminate\Support\Str;



class TutorMasterController extends Controller

{

    public $successStatus = 200;

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $totur = User::get();

        return view('admin.tutor.tutor');
    }

    public function ajaxList(Request $request)
    {

        $data['page'] = $request->page;

        $first_name = $request->first_name;

        $email = $request->email;

        $mobile = $request->mobile_id;

        $created_date = $request->created_date;

        $data['query'] = TutorMasterHelper::getListwithPaginate($first_name, $email, $mobile, $created_date);

        return view('admin.tutor.tutor_ajax', $data);
    }

    public function destroy($id)

    {

        $update = TutorMasterHelper::SoftDelete(array(), array('id' => $id));

        if ($update) {

            return response()->json([

                'message' => trans('messages.deletedSuccessfully')

            ]);
        } else {

            return response()->json([

                'message' =>  trans('messages.notDeleted')

            ]);
        }
    }

    public function show($id)
    {

        $data['tutor'] = TutorMasterHelper::getDetailsById($id);
        $data['level'] = TutorLevelDetailHelper::getDetailsById($id);

        if (isset($data['tutor']->id)) {

            return view('admin.tutor.tutor_view', $data);
        } else {

            abort(404);
        }
    }

    public function getUniversityDetails(Request $request)
    {

        $data['page'] = $request->page;



        $tutor_id = $request->tutor_id;

        $data['query'] = TutorUniversityDetailHelper::getListwithPaginate($tutor_id);

        return view('admin.tutor.tutor_university_list', $data);
    }

    public function getSubjectDetails(Request $request)
    {

        $data['page'] = $request->page;

        $tutor_id = $request->tutor_id;

        $data['query'] = TutorSubjectDetailHelper::getListwithPaginate($tutor_id);

        return view('admin.tutor.tutor_subject_list', $data);
    }

    public function getLevelDetails(Request $request)
    {

        $data['page'] = $request->page;

        $tutor_id = $request->tutor_id;

        $data['query'] = TutorLevelDetailHelper::getListwithPaginate($tutor_id);

        return view('admin.tutor.tutor_level_list', $data);
    }

    public function getOtherDetails(Request $request)
    {
        $data['page'] = $request->page;

        $tutor_id = $request->tutor_id;

        $data['query'] = TutorDetailHelper::getOtherListwithPaginate($tutor_id);

        return view('admin.tutor.tutor_other_list', $data);
    }


    function base64url_encode($str)
    {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }
    function generate_jwt($headers, $payload, $secret = '')
    {
        $secret = env('MERITHUB_CLIENT_SECRET');
        $headers_encoded = $this->base64url_encode(json_encode($headers));
        $payload_encoded = $this->base64url_encode(json_encode($payload));
        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
        $signature_encoded = $this->base64url_encode($signature);
        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
        return $jwt;
    }

    public function changeStatus(Request $request)
    {
        $character = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $randomString = substr(str_shuffle(str_repeat($character, 5)), 0, 4);
        $randomNumbers = substr(str_shuffle(str_repeat($numbers, 5)), 0, 4);
        $userUniqueId = $randomNumbers . '-' . $randomString;
        $query = UserHelper::updateStatus($request->id, $request->status, $userUniqueId);

        if ($query) {

            $getUserData = UserHelper::getUserDetails($request->id);
            if ($request->status == 'Accepted') {
                $html = '<p>Your account has been approved by admin now you can login.</p>';
                $subject = __('emails.tutor_account_email');
                $BODY = __('emails.tutor_account_body', ['USERNAME' => $getUserData->first_name, 'HTMLTABLE' => $html]);
                $body_email = __('emails.template', ['BODYCONTENT' => $BODY]);
                $mail = MailHelper::mail_send($body_email, $getUserData->email, $subject);
            }
            /*Merithub Code*/
            $clientId = env('MERITHUB_CLIENT_ID');
            $timeZone = env('APP_TIMEZONE');
            $headers = array('alg' => 'HS256', 'typ' => 'JWT');
            $payload = array('aud' => 'https://serviceaccount1.meritgraph.com/v1/' . $clientId . '/api/token', 'iss' => $clientId, 'expiry' => (time() + 55));
            $jwt = $this->generate_jwt($headers, $payload);
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
                $dataInsert = ApiAccessTokenHelper::save($token, $request->id);
                $lastId = $dataInsert;
                $getData = ApiAccessTokenHelper::getDetails($lastId);

                $curl = curl_init();
                if($getUserData->type == "2"){
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://serviceaccount1.meritgraph.com/v1/' . $clientId . '/users',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                            "name": "'.$getUserData->first_name.'",
                            "img": "'.$getUserData->profile_photo.'",
                            "lang": "en",
                            "clientUserId": "'.$getUserData->unique_user_id.'",
                            "email": "'.$getUserData->email.'",
                            "role": "C",
                            "timeZone": "'.$timeZone.'",
                            "permission": "CC"
                        }',
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: '.$getData->access_token,
                            'Content-Type: application/json'
                        ),
                    ));
                }
                else{
                    $name = $getUserData->first_name.' '.$getUserData->last_name;
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://serviceaccount1.meritgraph.com/v1/' . $clientId . '/users',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => '{
                            "name": "'.$name.'",
                            "img": "'.$getUserData->profile_photo.'",
                            "lang": "en",
                            "clientUserId": "'.$getUserData->unique_user_id.'",
                            "email": "'.$getUserData->email.'",
                            "role": "M",
                            "timeZone": "'.$timeZone.'",
                            "permission": "CJ"
                        }',
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: '.$getData->access_token,
                            'Content-Type: application/json'
                        ),
                    ));
                }
                $userAdded = curl_exec($curl);
                if (!$userAdded) {
                    echo curl_error($curl);
                }
                curl_close($curl);
                $userToken['api_response'] = $userAdded;
                $query = UserHelper::updateApiResponse($request->id, $userToken);
            }
            return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'data' => array('status' => $request->status)], 200);
        } else {

            return response()->json(['error_msg' => trans('messages.error'), 'data' => array()], 500);
        }
    }

    public function addHourlyRate(Request $request)
    {
        $update = TutorLevelDetailHelper::saveHourlyRate($request->tutor_id, $request->rate, $request->subject_id);

        if ($update) {
            return response()->json(['error_msg' => trans('messages.updatedSuccessfully'), 'data' => $update], 200);
        } else {

            return response()->json(['error_msg' => trans('messages.error'), 'data' => array()], 500);
        }
    }
    public function getCount(Request $request)
    {

        $data = TutorLevelDetailHelper::getDetailsById($request->id);

        return response()->json(['error_msg' => 'Success', 'data' => $data], 200);
    }
}
