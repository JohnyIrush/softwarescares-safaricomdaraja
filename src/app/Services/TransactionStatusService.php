<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;

class TransactionStatusService extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function transaction()
    {
        $url = App::environment('production')? "https://live.safaricom.co.ke/mpesa/transactionstatus/v1/query" : "https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query";

        $body = [
            "InitiatorName" => "testapi",
            "SecurityCredential" => $this->darajaPasswordGenerator(),
            "CommandID" => "TransactionStatusQuery",
            "TransactionID" => $this->request->transactionid,
            "PartyA" => env("MPESA_SHORTCODE"),
            "IdentifierType" => 2,
            "ResultURL" => "https://daraja.softwarescares.com/api/TransactionStatus/result",
            "QueueTimeOutURL" => "https://daraja.softwarescares.com/api/TransactionStatus/queue",
            "Remarks" => "CheckTransaction",
            "Occassion" => "VerifyTransaction",
        ];

        return json_encode($this->serviceRequest($url, $body));
    }

    /*** Handle Transaction Response ***/

    public function result($result)
    {
        
    }
}