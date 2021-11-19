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
}