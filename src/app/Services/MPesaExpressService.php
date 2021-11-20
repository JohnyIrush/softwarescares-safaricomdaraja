<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
use Softwarescares\Safaricomdaraja\app\Extensions\Transaction;

class MPesaExpressService extends Transaction implements TransactionInterface
{
    use AuthorizationService;

    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    //-- stk push transaction

    public function transaction()
    {
        $url = App::environment('production')? "https://live.safaricom.co.ke/mpesa/stkpush/v1/processrequest" : "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

        $body = [
            'BusinessShortCode' => env("MPESA_SHORTCODE"),
            'Password' => $this->darajaPasswordGenerator(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $this->request->amount,
            'PartyA' => $this->request->phone,
            'PartyB' => env("MPESA_SHORTCODE"),
            'PhoneNumber' => $this->request->phone,
            'CallBackURL' => 'http://softwarescares.com',
            'AccountReference' => "SoftwaresCares",
            'TransactionDesc' => "Lipa Na M-PESA",
        ];

        return json_encode($this->serviceRequest($url, $body));
    }

    public function mpesaExpressQuery()
    {
        $url = App::environment('production')? "https://live.safaricom.co.ke/mpesa/stkpushquery/v1/query" : "https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query";
        $body = [
            "BusinessShortCode" => 174379,
            "Password" => "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjExMTIwMTcxODM4",
            "Timestamp" => "20211120171838",
            "CheckoutRequestID" => "ws_CO_201120211705556658",
        ];

        return json_encode($this->serviceRequest($url, $body));
    }
}