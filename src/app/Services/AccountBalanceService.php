<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;
use Softwarescares\Safaricomdaraja\app\Notification\TransactionNotification;

class AccountBalanceService extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    public function __construct()
    {

    }

    public function transaction($request)
    {
        $url = App::environment('production')? "https://live.safaricom.co.ke/mpesa/accountbalance/v1/query" : "https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query";

        $body = [
            "InitiatorName" => "testapi",
            "SecurityCredential" => $this->darajaPasswordGenerator(),
            "InitiatorPassword" => "Safaricom978!",
            "CommandID" => "AccountBalance",
            "PartyA" => config("safaricomdaraja.MPESA.BUSINESSSHORTCODE"),
            "IdentifierType" => "4",
            "Remarks" => "Account Balance",
            "QueueTimeOutURL" => config('safaricomdaraja.APP_DOMAIN_URL') . "/accountbalance/queue-timeout",
            "ResultURL" => config('safaricomdaraja.APP_DOMAIN_URL') . "/accountbalance/result",
        ];

        return $this->serviceRequest($url, $body);
    }

    /*** Handle Transaction Response ***/

    public function result($result, $user)
    {
        // Fire Notification

        Notification::send($user, new TransactionNotification($result));
    }

    public function queueTimeOutURL($request)
    {

    }

}