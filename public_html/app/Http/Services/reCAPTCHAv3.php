<?php

namespace App\Http\Services;

class reCAPTCHAv3 
{
    static function validar($token)
    {
        $RECAPTCHA_V3_SECRET_KEY = env('RECAPTCHA_V3_SECRET_KEY');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'secret' => $RECAPTCHA_V3_SECRET_KEY,
            'response' => $token,
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $arrResponse = json_decode($response, true);

        return $arrResponse["success"];
    }
}
