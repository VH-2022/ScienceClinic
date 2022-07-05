<?php

namespace App\Http\Controllers\Frontend\Tutor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class TutorMerithubController extends Controller
{
    function base64url_encode($str)
    {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }
    function generate_jwt($headers, $payload, $secret = '$2a$04$85BcpKN9/KQARXVyrGteMuG.B74jkYAs58Q0ouGHbZ9r5gNNJO7u.')
    {
        $headers_encoded = $this->base64url_encode(json_encode($headers));
        $payload_encoded = $this->base64url_encode(json_encode($payload));
        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
        $signature_encoded = $this->base64url_encode($signature);
        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
        return $jwt;
    }
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
    public function getToken()
    {
        $headers = array('alg' => 'HS256', 'typ' => 'JWT');
        $payload = array('aud' => 'https://serviceaccount1.meritgraph.com/v1/cafpqokt2n9terdvuc3g/api/token', 'iss' => 'cafpqokt2n9terdvuc3g', 'expiry' => (time() + 60), 'iat' => (time() + 60));
        $jwt = $this->generate_jwt($headers, $payload);
        dd($jwt);
        // $is_jwt_valid = $this->is_jwt_valid($jwt, '$2a$04$85BcpKN9/KQARXVyrGteMuG.B74jkYAs58Q0ouGHbZ9r5gNNJO7u.');
        // $request_headers = array ("Content-Type: application/x-www-form-urlencoded");
        // $ch = curl_init();
        // $curlConfig = array(
        //     CURLOPT_URL            => "https://serviceaccount1.meritgraph.com/v1/cafpqokt2n9terdvuc3g/api/token",
        //     CURLOPT_POST           => true,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_HTTPHEADER     => $request_headers,
        //     CURLOPT_POSTFIELDS     => array(
        //         'assertion' => 'Bearer'.$jwt,
        //         'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
        //     )
        // );
        // curl_setopt_array($ch, $curlConfig);
        // $result = curl_exec($ch);
        // curl_close($ch);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://serviceaccount1.meritgraph.com/v1/cafpqokt2n9terdvuc3g/api/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer '.$jwt,
                'grant_type: grant_type=urn:ietf:params:oauth:grant-type:jwt-bearer'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        die;
    }
}
