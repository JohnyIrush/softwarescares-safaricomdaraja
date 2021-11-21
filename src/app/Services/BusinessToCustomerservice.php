<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\TransactionEvent;
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
        $url = App::environment('production')? "https://live.safaricom.co.ke/mpesa/b2c/v1/paymentrequest" : "https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest";

        $body = [
            "InitiatorName" => "testapi",
            "SecurityCredential" => $this->darajaPasswordGenerator(),
            "CommandID" => "BusinessPayment",
            "Amount" => $this->request->amount,
            "PartyA" => env("MPESA_SHORTCODE"),
            "PartyB" => $this->request->phone,
            "Remarks" => "Test remarks",
            "QueueTimeOutURL" => "https://daraja.softwarescares.com/b2c/queue",
            "ResultURL" => env("MPESA_APP_DOMAIN_URL") . "/businesstocustomer/result",
            "Occassion" => "rrrrrrrrrrrr" 
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

            event(new TransactionEvent($result));
        }
        else
        {
            // Fire Notification
        }
    }

}