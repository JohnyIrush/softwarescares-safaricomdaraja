<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\CustomerToBusinessTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;
use Symfony\Contracts\Translation\TranslatableInterface;

class CustomerToBusinessService extends Transaction implements TransactionInterface
{
    use AuthorizationService;



    public function __construct()
    {

    }

    /*** Customer To business ***/
    public function transaction($request)
    {
        $url = (config('safaricomdaraja.MPESA.ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/c2b/v1/simulate" : "https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate";

        $body = [
            "CommandID" =>  "CustomerPayBillOnline",//config("safaricomdaraja.MPESA.COMMANDID"),
            "Amount" => $request["Amount"],
            "Msisdn" => $request["Phone"],
            "BillRefNumber" => $request["Account"],
            "ShortCode" => config("safaricomdaraja.MPESA.SHORTCODE")
        ];

        return $this->serviceRequest($url, $body);
    }

    /*** Handle Transaction Response ***/

    public function validation($result)
    {
        Log::info("Validation Hit!");
        Log::info(($result));
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
        $url = (config('safaricomdaraja.MPESA.ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/c2b/v1/registerurl" : "https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl";

        $body = array(
            "ShortCode" => config("safaricomdaraja.MPESA.SHORTCODE"),
            "ResponseType" => "Completed",
            "ConfirmationURL" => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . "/confirmation",
            "ValidationURL" => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . "/validation"
        );

        return $this->serviceRequest($url, $body); 
    }
}