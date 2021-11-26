<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;
use Softwarescares\Safaricomdaraja\app\Notification\TransactionReversalNotification;

class TransactionReversalService extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function transaction($request)
    {
        $url = App::environment('production')? "https://live.safaricom.co.ke/mpesa/reversal/v1/request" : "https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request";

        $body = [
            "InitiatorName" => "testapi",
            "SecurityCredential" => $this->darajaPasswordGenerator(),
            "CommandID" => "TransactionReversal",
            "TransactionID" => $this->request->TransactionID,
            "Amount" => $this->request->amount,
            "ReceiverParty" => env("safaricomdaraja.MPESA.BUSINESSSHORTCODE"),
            "RecieverIdentifierType" => "11",
            "QueueTimeOutURL" => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . "/reversal/queue-timeout",
            "ResultURL" => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . "/reversal/result",
            "Remarks" => "please",
            "Occasion" => "work"
        ];

        return json_encode($this->serviceRequest($url, $body));
    }

    /*** Handle Transaction Response ***/

    public function result($result, $user)
    {
        // Fire Notification

        Notification::send($user, new TransactionReversalNotification($result));
        
        // Fire event to update database
    }

    public function queueTimeOutURL(Request $request)
    {

    }
}