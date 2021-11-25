<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\BusinessToCustomerTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;

class BusinessToCustomerservice extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    public function __construct()
    {
    }

    public function transaction($request)
    {
        $url = (config('safaricomdaraja.MPESA.ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/b2c/v1/paymentrequest" : "https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest";

        $body = [
            "InitiatorName" => 'testapi',//config("safaricomdaraja.app.name"),
            "SecurityCredential" => $this->darajaPasswordGenerator(),
            "CommandID" => "BusinessPayment",
            "Amount" => $request["Amount"],
            "PartyA" => config("safaricomdaraja.MPESA.BUSINESSSHORTCODE"),
            "PartyB" => $request["Phone"],
            "Remarks" => "lipa Na Mpesa",
            "QueueTimeOutURL" => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . "/businesstocustomer/queue-timeout",
            "ResultURL" => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . "/businesstocustomer/result",
            "Occassion" => "Business To Customers" 
        ];

        return $this->serviceRequest($url, $body);
    }

    /*** Handle Transaction Response ***/

    public function result($result)
    {
        Log::info("B2C results hit");
        Log::info($result);
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