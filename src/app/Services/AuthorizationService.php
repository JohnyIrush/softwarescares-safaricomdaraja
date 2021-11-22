<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

trait AuthorizationService
{
    public function constructor()
    {

    }
    
    /**generates the 64 encoded password
     * timestamp
     * passkey
     * bussinessShortCode
     * generate password
     * 
     */
    public function darajaPasswordGenerator()
    {
        return base64_encode(env('MPESA_BUSINESSSHORTCODE') // Business Short Code
                            .env("MPESA_PASSEKEY") // daraja api pass key
                            .Carbon::rawParse('now')->format('YmdHms')); // timestamp
    }

    /** Generate New Access Token */
    public function darajaAccessTokenGenerator()
    {

        $url = (env('MPESA_ENV') === "production") ? "https://live.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials" : "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt_array($curl,
        [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array("Authorization: Basic ".base64_encode(env("MPESA_CONSUMER_KEY").":".env("MPESA_CONSUMER_SECRET"))),
            CURLOPT_HEADER =>false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true
        ]);
        print_r(base64_encode(env("MPESA_CONSUMER_KEY").":".env("MPESA_CONSUMER_SECRET")));
        return json_decode(curl_exec($curl))->access_token;
    }
}