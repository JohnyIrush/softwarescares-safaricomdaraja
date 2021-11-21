<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\BusinessToCustomerTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;

class BusinessToCustomerservice extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function transaction()
    {
        $url = (env('MPESA_ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/b2c/v1/paymentrequest" : "https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest";

        $body = [
            "InitiatorName" => env("APP_NAME"),
            "SecurityCredential" => $this->darajaPasswordGenerator(),
            "CommandID" => "BusinessPayment",
            "Amount" => $this->request->amount,
            "PartyA" => env("MPESA_SHORTCODE"),
            "PartyB" => $this->request->phone,
            "Remarks" => "",
            "QueueTimeOutURL" => env("MPESA_APP_DOMAIN_URL") . "/businesstocustomer/queue-timeout",
            "ResultURL" => env("MPESA_APP_DOMAIN_URL") . "/businesstocustomer/result",
            "Occassion" => "" 
        ];

        return json_encode($this->serviceRequest($url, $body));
    }

    /*** Handle Transaction Response ***/

    public function result($result)
    {
        if($result["Body"]["stkCallback"]["ResultCode"] === "0")
        {
            // Fire Notification

            // Fire an event to Update Transaction Table 

            event(new BusinessToCustomerTransactionEvent($result));
        }
        else
        {
            // Fire Notification
        }
    }

    public function queueTimeout($result)
    {
        //-- Notification

    }

}