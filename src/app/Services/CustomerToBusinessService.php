<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\CustomerToBusinessTransactionEvent;
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
        $url = (env('MPESA_ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/c2b/v1/simulate" : "https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate";

        $body = [
            "CommandID" =>  env("MPESA_COMMANDID"),
            "Amount" => $this->request->amount,
            "Msisdn" => $this->request->phone,
            "BillRefNumber" => Auth::user()->account,
            "ShortCode" => env("MPESA_SHORTCODE")
        ];

        return json_encode($this->serviceRequest($url, $body));
    }

    /*** Handle Transaction Response ***/

    public function validation($result)
    {
        if($result->TransAmount === "0")
        {
            // Fire Notification


            // Fire an event to Update Transaction Table 

            event(new CustomerToBusinessTransactionEvent($result));

            // Return validation response accepted depending on our validation rules

            return json_encode(
                [
                    "ResultCode" => 0,
                    "ResultDesc" => "Accepted"
                ]
            );
        }
        else
        {
            // Fire Notification

            // Return validation response - rejected depending on our validation rules
            return json_encode(
                [
                    "ResultCode" => 1,
                    "ResultDesc" => "Rejected"
                ]
            );            
        }
    }

    public function confirmation($result)
    {
        // Fire Notification
        
    }

    public function result($result)
    {
        
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
        $url = (env('MPESA_ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/c2b/v1/registerurl" : "https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl";

        $body = array(
            "ShortCode" => env("MPESA_SHORTCODE"),
            "ResponseType" => "Completed",
            "ConfirmationURL" => env("MPESA_APP_DOMAIN_URL") . "/confirmation",
            "ValidationURL" => env("MPESA_APP_DOMAIN_URL") . "/validation"
        );

        return json_encode($this->serviceRequest($url, $body)); 
    }
}