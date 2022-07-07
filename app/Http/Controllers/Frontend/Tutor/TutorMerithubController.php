<?php

namespace App\Http\Controllers\Frontend\Tutor;

use App\Helpers\ApiAccessTokenHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class TutorMerithubController extends Controller
{
    function is_jwt_valid($jwt, $secret = 'secret')
    {
        // split the jwt
        $tokenParts = explode('.', $jwt);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signature_provided = $tokenParts[2];

        // check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
        $expiration = json_decode($payload)->expiry;
        $is_token_expired = ($expiration - time()) < 0;

        // build a signature based on the header and payload using the secret
        $base64_url_header = $this->base64url_encode($header);
        $base64_url_payload = $this->base64url_encode($payload);
        $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
        $base64_url_signature = $this->base64url_encode($signature);

        // verify it matches the signature provided in the jwt
        $is_signature_valid = ($base64_url_signature === $signature_provided);

        if ($is_token_expired || !$is_signature_valid) {
            echo "FALSE";
        } else {
            echo "TRUE";
        }
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
    public function getToken()
    {
        $clientId = env('MERITHUB_CLIENT_ID');
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
            ApiAccessTokenHelper::save($token);
        }
    }
}
