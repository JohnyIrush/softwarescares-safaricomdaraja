<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;

class TransactionReversalService extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function transaction()
    {
        $url = App::environment('production')? "https://live.safaricom.co.ke/mpesa/reversal/v1/request" : "https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request";

        $body = [
            "InitiatorName" => "testapi",
            "SecurityCredential" => $this->darajaPasswordGenerator(),
            "CommandID" => "TransactionReversal",
            "TransactionID" => $this->request->transactionid,
            "Amount" => $this->request->amount,
            "ReceiverParty" => env("MPESA_SHORTCODE"),
            "RecieverIdentifierType" => "11",
            "QueueTimeOutURL" => "https://daraja.softwarescares.com/reverseTransaction/queue",
            "ResultURL" => "https://daraja.softwarescares.com/reverseTransaction/result",
            "Remarks" => "please",
            "Occasion" => "work"
        ];

        return json_encode($this->serviceRequest($url, $body));
    }

    /*** Handle Transaction Response ***/

    public function result($result)
    {
        
    }
}