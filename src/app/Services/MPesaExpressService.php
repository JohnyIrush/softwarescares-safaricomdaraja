<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\MPesaExpressTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;

class MPesaExpressService extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    //-- stk push transaction

    public function transaction()
    {
        $url = (env('MPESA_ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/stkpush/v1/processrequest" : "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

        $body = [
            'BusinessShortCode' => env("MPESA_SHORTCODE"),
            'Password' => $this->darajaPasswordGenerator(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $this->request->amount,
            'PartyA' => $this->request->phone,
            'PartyB' => env("MPESA_SHORTCODE"),
            'PhoneNumber' => $this->request->phone,
            'CallBackURL' => env("MPESA_APP_DOMAIN_URL") . '/mpesaexpress/result',
            'AccountReference' => env("APP_NAME"),
            'TransactionDesc' => "Lipa Na M-PESA",
        ];

        $response = json_decode($this->serviceRequest($url, $body));

        if($response->ResponseCode === "0")
        {
            // Fire Notification

        }
        else
        {
            // Fire Notification
        }
    }

    /*** Handle Transaction Response ***/

    public function result($result)
    {
        if($result["Body"]["stkCallback"]["ResultCode"] === "0")
        {
            // Fire Notification

            // Fire an event to Update Transaction Table 

            event(new MPesaExpressTransactionEvent($result));
        }
        else
        {
            // Fire Notification
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