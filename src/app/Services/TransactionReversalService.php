<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\CustomerToBusinessTransactionReversalEvent;
use Softwarescares\Safaricomdaraja\app\Events\CustomerToBusinessTransactionReversalEventListener;
use Softwarescares\Safaricomdaraja\app\Events\TransactionNotificationEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionReversalEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionUpdateReversalEvent;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;
use Softwarescares\Safaricomdaraja\app\Notification\TransactionReversalNotification;

class TransactionReversalService extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    public function __construct()
    {

    }

    public function transaction($request)
    {
        $url = App::environment('production')? "https://live.safaricom.co.ke/mpesa/reversal/v1/request" : "https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request";

        $body = [
            "InitiatorName" => "testapi",
            "SecurityCredential" => $this->darajaPasswordGenerator(),
            "CommandID" => "TransactionReversal",
            "TransactionID" => $request->TransactionID,
            "Amount" => $request->amount,
            "ReceiverParty" => env("safaricomdaraja.MPESA.BUSINESSSHORTCODE"),
            "RecieverIdentifierType" => "11",
            "QueueTimeOutURL" => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . "/reversal/queue-timeout",
            "ResultURL" => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . "/reversal/result",
            "Remarks" => "please",
            "Occasion" => "work"
        ];

        session(['transaction_type' => $request->transaction_type]);
        session(['transaction_id' => $request->transaction_id]);

        return '{
            "OriginatorConversationID": "71840-27539181-07",
            "ConversationID": "AG_20210709_12346c8e6f8858d7b70a",
            "ResponseCode":"0",
            "ResponseDescription": "Accept the service request successfully."
            }';
        return json_encode($this->serviceRequest($url, $body));
    }

    /*** Handle Transaction Response ***/

    public function result($result, $user)
    {
        // Fire Notification

        event(new  TransactionNotificationEvent ([
            'success' => [
               "ResultDesc" => $result->Result->ResultDesc,
               "ResultCode" => $result->Result->ResultCode
            ],
            'user' => $user
        ]));

        
        // Fire event to update database

        event(new TransactionReversalEvent($result));

        if ($result->Result->ResultCode == 21)
        {
            
           
            // Fire Event Update Transaction reversal id and status

            event(new TransactionUpdateReversalEvent([
                "transaction_type" => 'c2b',//session("transaction_type"),
                "transaction_id" => 1,//session("transaction_id")
            ]));

        }
    }

    public function queueTimeOutURL(Request $request)
    {

    }
}