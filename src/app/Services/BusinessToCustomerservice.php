<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\BusinessToCustomerTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionNotificationEvent;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;
use Softwarescares\Safaricomdaraja\app\Models\CurrentTransactionUser;

class BusinessToCustomerservice extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    public function __construct()
    {
    }

    public function transaction($request)
    {
        $url = (config('safaricomdaraja.MPESA.ENV') === "production") ? "https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest" : "https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest";

        $body = [
            "InitiatorName" =>config("safaricomdaraja.MPESA.INITIATORNAME"),
            "SecurityCredential" => $this->darajaPasswordGenerator(),
            "CommandID" => "BusinessPayment",
            "Amount" => $request["Amount"],
            "PartyA" => config("safaricomdaraja.MPESA.BUSINESSSHORTCODE"),
            "PartyB" => $request["Phone"],
            "Remarks" => "lipa Na Mpesa",
            "QueueTimeOutURL" => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . "/businesstocustomer/queue-timeout",
            "ResultURL" => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . "/businesstocustomer/result",
            "Occassion" => "Business To Customers" 
        ];


        return $this->serviceRequest($url, $body);
    }

    /*** Handle Transaction Response ***/

    public function result($result, $user)
    {
        Log::info("B2C results hit");
        Log::info(json_encode($result));
            // Fire Notification
            event(new  TransactionNotificationEvent ([
                'success' => [
                   "ResultDesc" => $result->Result->ResultDesc,
                   "ResultCode" => $result->Result->ResultCode
                ],
                'user' => User::find(CurrentTransactionUser::find(1)->current_transaction_user_id)
            ]));
            // Fire an event to Update Transaction Table 

            event(new BusinessToCustomerTransactionEvent($result));

    }

    public function queueTimeout($result)
    {
        //-- Notification

    }

}