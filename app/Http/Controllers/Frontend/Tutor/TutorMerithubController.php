<?php

namespace App\Http\Controllers\Frontend\Tutor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TutorMerithubController extends Controller
{
    function base64url_encode($str)
    {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }
    function generate_jwt($headers, $payload, $secret = 'CLIENT_SECRET')
    {
        $headers_encoded = $this->base64url_encode(json_encode($headers));
        $payload_encoded = $this->base64url_encode(json_encode($payload));
        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
        $signature_encoded = $this->base64url_encode($signature);
        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
        return $jwt;
    }
    public function getJWTToken()
    {
        $headers = array('alg' => 'HS256', 'typ' => 'JWT');
        $payload = array('aud' => 'https://serviceaccount1.meritgraph.com/v1/{cafpqokt2n9terdvuc3g}/api/token', 'iss' => 'CLIENT_ID', 'expiry' => 3600);
        $jwt = $this->generate_jwt($headers, $payload);
        echo $jwt;
    }
}
