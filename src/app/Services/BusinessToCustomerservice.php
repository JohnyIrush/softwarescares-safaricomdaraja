<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\BusinessToCustomerTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionNotificationEvent;
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

        return '{    
            "ConversationID": "AG_20191219_00005797af5d7d75f652",    
            "OriginatorConversationID": "16740-34861180-1",    
            "ResponseCode": "0",    
            "ResponseDescription": "Accept the service request successfully."
           }';

        return $this->serviceRequest($url, $body);
    }

    /*** Handle Transaction Response ***/

    public function result($result, $user)
    {
        Log::info("B2C results hit");
        Log::info(json_encode($result));
            // Fire Notification
            event(new  TransactionNotificationEvent ([
                'success' => [
                   "ResultDesc" => $result->Result->ResultDesc,
                   "ResultCode" => $result->Result->ResultCode
                ],
                'user' => $user
            ]));
            // Fire an event to Update Transaction Table 

            event(new BusinessToCustomerTransactionEvent($result));

    }

    public function queueTimeout($result)
    {
        //-- Notification

    }

}