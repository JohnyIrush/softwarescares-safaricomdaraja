<?php

namespace Softwarescares\Safaricomdaraja\app\Extensions;

use Softwarescares\Safaricomdaraja\app\Services\AuthorizationService;

class Transaction
{
    use AuthorizationService;
    /*** make all the http request ***/
    public function serviceRequest($url, $body)
    {
        $curl = curl_init();

        curl_setopt_array($curl,
        [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => ["Content-Type: application/json", "Authorization:Bearer ".$this->darajaAccessTokenGenerator()],
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => json_encode($body),
        ]);


        # curl_close($curl);
        
        dd(curl_exec($curl));
        return json_encode(curl_exec($curl));
    }
}