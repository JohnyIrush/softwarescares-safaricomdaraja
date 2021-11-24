<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\MpesaExpressTransactionAcceptedEvent;
use Softwarescares\Safaricomdaraja\app\Events\MPesaExpressTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionStatusNotificationEvent;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;

class MPesaExpressService extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    public function __construct()
    {
        
    }

    //-- stk push transaction

    public function transaction($request)
    {
        $url = (config('safaricomdaraja.MPESA.ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/stkpush/v1/processrequest" : "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

        $body = [
            'BusinessShortCode' => config("safaricomdaraja.MPESA.BUSINESSSHORTCODE"),
            'Password' => $this->darajaPasswordGenerator(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $request["Amount"],
            'PartyA' => $request["Phone"],
            'PartyB' => config("safaricomdaraja.MPESA.BUSINESSSHORTCODE"),
            'PhoneNumber' => $request["Phone"],
            'CallBackURL' => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . '/mpesaexpress/result',
            'AccountReference' => config("app.name"),
            'TransactionDesc' => "Lipa Na M-PESA",
        ];

        Log::info(json_encode($body));

        Log::info(json_encode($this->serviceRequest($url, $body)));
        return $this->serviceRequest($url, $body);

    }

    /*** Handle Transaction Response ***/

    public function result($result)
    {
        LOG::info($result);
        if($result["Body"]["stkCallback"]["ResultCode"] === "0")
        {
             LOG::info("STK Result Success");
             LOG::info($result);
             // Fire Notification
             event(new  MpesaExpressTransactionAcceptedEvent ([
                 'error' => ['errorMessage' => 'success!'],//$response,
                 //'user' => $user
             ]));

            // Fire an event to Update Transaction Table 

            event(new MPesaExpressTransactionEvent($result));
        }
        else
        {
            // Fire Notification
            event(new  TransactionStatusNotificationEvent ([
                'error' => ['errorMessage' => 'ERROR!'],//$response,
                //user' => $user
            ]));
            LOG::info("STK Error");
            LOG::info($result);
        }
    }

    public function mpesaExpressQuery($CheckoutRequestID)
    {
        $url = (config('safaricomdaraja.MPESA_ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/stkpushquery/v1/query" : "https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query";
        $body = [
            "BusinessShortCode" => env("safaricomdaraja.MPESA_SHORTCODE"),
            "Password" => $this->darajaPasswordGenerator(),
            "Timestamp" => Carbon::rawParse('now')->format('YmdHms'),
            "CheckoutRequestID" => $CheckoutRequestID,
        ];

        return json_decode($this->serviceRequest($url, $body));
    }
}