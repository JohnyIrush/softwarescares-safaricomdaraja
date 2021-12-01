<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Events\TransactionNotificationEvent;
use Softwarescares\Safaricomdaraja\app\Events\MPesaExpressTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionStatusNotificationEvent;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;

use App\Models\User;
use Softwarescares\Safaricomdaraja\app\Models\CurrentTransactionUser;

class MPesaExpressService extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    public function __construct()
    {
        
    }

    //-- stk push transaction

    public function transaction($request)
    {
        $url = (config('safaricomdaraja.MPESA.ENV') === "production") ? "https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest" : "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

        $body = [
            'BusinessShortCode' => config("safaricomdaraja.MPESA.BUSINESSSHORTCODE"),
            'Password' => $this->darajaPasswordGenerator(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $request["Amount"],
            'PartyA' => $request["Phone"],
            'PartyB' => config("safaricomdaraja.MPESA.BUSINESSSHORTCODE"),
            'PhoneNumber' => $request["Phone"],
            'CallBackURL' => config("safaricomdaraja.MPESA.APP_DOMAIN_URL") . '/mpesaexpress/result',//"https://packageengine.softwarescares.com/mpesaexpress/result",
            'AccountReference' => config("app.name"),
            'TransactionDesc' => "Lipa Na M-PESA",
        ];

        return $this->serviceRequest($url, $body);

    }

    /*** Handle Transaction Response ***/

    public function result($result, $user)
    {
             // Fire Notification
             event(new  TransactionNotificationEvent ([
                 'success' => [
                    "ResultDesc" => $result["Body"]["stkCallback"]["ResultDesc"],
                    "ResultCode" => $result["Body"]["stkCallback"]["ResultCode"]
                 ],
                 'user' => User::find(CurrentTransactionUser::find(1)->current_transaction_user_id)
             ]));

            // Fire an event to Update Transaction Table 

            event(new MPesaExpressTransactionEvent($result));
    }

    public function mpesaExpressQuery($CheckoutRequestID)
    {
        $url = (config('safaricomdaraja.MPESA_ENV') === "production") ? "https://live.safaricom.co.ke/mpesa/stkpushquery/v1/query" : "https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query";
        $body = [
            "BusinessShortCode" => env("safaricomdaraja.MPESA_SHORTCODE"),
            "Password" => $this->darajaPasswordGenerator(),
            "Timestamp" => Carbon::rawParse('now')->format('YmdHms'),
            "CheckoutRequestID" => $CheckoutRequestID,
        ];

        return json_decode($this->serviceRequest($url, $body));
    }
}