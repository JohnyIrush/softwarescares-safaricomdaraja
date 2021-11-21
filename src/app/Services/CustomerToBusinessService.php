<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\TransactionEvent;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;
use Symfony\Contracts\Translation\TranslatableInterface;

class CustomerToBusinessService extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /*** Customer To business ***/
    public function transaction()
    {
        $url = App::environment('production')? "https://live.safaricom.co.ke/mpesa/c2b/v1/simulate" : "https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate";

        $body = [
            "CommandID" =>  "CustomerPayBillOnline",
            "Amount" => $this->request->amount,
            "Msisdn" => $this->request->phone,
            "BillRefNumber" => "00000",
            "ShortCode" => env("MPESA_SHORTCODE")
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

    
    /**
     * Register validation and confirmation URLs on M-Pesa 
     * The M-Pesa API enables you to register 
     * the callback URL’s via which your application will
     *  receive payment notifications for the payment to your
     *  Paybill or till number. The URLs are used by the C2B payment 
     * simulation API for sending transaction details
     *  to your application.
     */
    
    public function customerToBusinessRegisterURL()
    {
        $url = App::environment('production')? "https://live.safaricom.co.ke/mpesa/c2b/v1/registerurl" : "https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl";

        $body = array(
            "ShortCode" => env("MPESA_SHORTCODE"),
            "ResponseType" => "Completed",
            "ConfirmationURL" => env("MPESA_CONFIRMATION_URL"),
            "ValidationURL" => env("MPESA_VALIDATION_URL")
        );

        return json_encode($this->serviceRequest($url, $body)); 
    }
}