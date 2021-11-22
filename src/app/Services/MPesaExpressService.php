<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\MPesaExpressTransactionEvent;
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
        $url = (env('MPESA_ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/stkpush/v1/processrequest" : "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

        //dd($request["Amount"]);
        $body = [
            'BusinessShortCode' => env("MPESA_BUSINESSSHORTCODE"),
            'Password' => $this->darajaPasswordGenerator(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $request["Amount"],
            'PartyA' => $request["Phone"],
            'PartyB' => env("MPESA_BUSINESSSHORTCODE"),
            'PhoneNumber' => $request["Phone"],
            'CallBackURL' => env("MPESA_APP_DOMAIN_URL") . '/api/mpesaexpress/result',
            'AccountReference' => env("APP_NAME"),
            'TransactionDesc' => "Lipa Na M-PESA",
        ];

        //dd($body);
        $response = json_decode($this->serviceRequest($url, $body));
        //dd($response);
        if($response && $response["ResponseCode"] === "0")
        {
            // Fire Notification
            // dd($response);
            LOG::info("STK Response success");

        }
        else
        {
            // Fire Notification
            // dd($response);
            LOG::info("STK Response Error");
        }
    }

    /*** Handle Transaction Response ***/

    public function result($result)
    {
        if($result["Body"]["stkCallback"]["ResultCode"] === "0")
        {
            // Fire Notification
             LOG::info("STK Result Success");
             LOG::info($result);
            // Fire an event to Update Transaction Table 

            event(new MPesaExpressTransactionEvent($result));
        }
        else
        {
            // Fire Notification
            LOG::info("STK Error");
            LOG::info($result);
        }
    }

    public function mpesaExpressQuery($CheckoutRequestID)
    {
        $url = (env('MPESA_ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/stkpushquery/v1/query" : "https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query";
        $body = [
            "BusinessShortCode" => env("MPESA_SHORTCODE"),
            "Password" => $this->darajaPasswordGenerator(),
            "Timestamp" => Carbon::rawParse('now')->format('YmdHms'),
            "CheckoutRequestID" => $CheckoutRequestID,
        ];

        return json_decode($this->serviceRequest($url, $body));
    }
}