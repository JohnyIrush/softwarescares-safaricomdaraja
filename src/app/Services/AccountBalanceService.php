<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;

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
            "PartyA" => env("MPESA_SHORTCODE"),
            "IdentifierType" => "4",
            "Remarks" => "AccountBalance",
            "QueueTimeOutURL" => "https://daraja.softwarescares.com/AccountBalance/queue",
            "ResultURL" => "https://daraja.softwarescares.com/AccountBalance/result",
        ];

        return json_encode($this->serviceRequest($url, $body));
    }

    /*** Handle Transaction Response ***/

    public function result($result)
    {
        
    }
}