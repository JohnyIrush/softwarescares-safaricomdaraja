<?php

namespace Softwarescares\Safaricomdaraja\app\Services;

use Illuminate\Support\Facades\App;
use Softwarescares\Safaricomdaraja\app\Contracts\TransactionInterface;
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
}