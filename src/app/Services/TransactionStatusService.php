<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;
use Softwarescares\Safaricomdaraja\app\Notification\TransactionNotification;

class TransactionStatusService extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    public function __construct()
    {

    }

    public function transaction($request)
    {
        $url = App::environment('production')? "https://api.safaricom.co.ke/mpesa/transactionstatus/v1/query" : "https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query";

        $body = [
            "InitiatorName" => "testapi",
            "SecurityCredential" => $this->darajaPasswordGenerator(),
            "CommandID" => "TransactionStatusQuery",
            "TransactionID" => $request->transactionid,
            "PartyA" => config("safaricomdaraja.MPESA.BUSINESSSHORTCODE"),
            "IdentifierType" => 2,
            "QueueTimeOutURL" => config('safaricomdaraja.APP_DOMAIN_URL') . "/transaction-status/queue-timeout",
            "ResultURL" => config('safaricomdaraja.APP_DOMAIN_URL') . "/transaction-status/result",
            "Remarks" => "CheckTransaction",
            "Occassion" => "VerifyTransaction",
        ];

        return $this->serviceRequest($url, $body);
    }

    /*** Handle Transaction Response ***/

    public function result($result, $user)
    {
        // Fire Notification

        Notification::send($user, new TransactionNotification($result));
    }
}