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
        #dd(config('safaricomdaraja.MPESA.BUSINESSSHORTCODE') . " " . config("safaricomdaraja.MPESA.PASSEKEY"));
        return base64_encode(config('safaricomdaraja.MPESA.BUSINESSSHORTCODE') // Business Short Code
                            .config("safaricomdaraja.MPESA.PASSEKEY") // daraja api pass key
                            .Carbon::rawParse('now')->format('YmdHms')); // timestamp
    }

    /** Generate New Access Token */
    public function darajaAccessTokenGenerator()
    {

        #dd(( config("safaricomdaraja.MPESA.CONSUMER_KEY").":".config("safaricomdaraja.MPESA.CONSUMER_SECRET")) );
        $url = (config('safaricomdaraja.MPESA.ENV') === "production") ? "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials" : "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt_array($curl,
        [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array("Authorization: Basic ".base64_encode(config("safaricomdaraja.MPESA.CONSUMER_KEY").":".config("safaricomdaraja.MPESA.CONSUMER_SECRET"))),
            CURLOPT_HEADER =>false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true
        ]);
        # print_r(base64_encode(env("MPESA_CONSUMER_KEY").":".env("MPESA_CONSUMER_SECRET")));
        # dd((json_decode(curl_exec($curl))));
        return isset(json_decode(curl_exec($curl))->access_token) == true? json_decode(curl_exec($curl))->access_token : "";
    }
}