<?php

namespace Softwarescares\Safaricomdaraja\app\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;
use Softwarescares\Safaricomdaraja\app\Events\MPesaExpressTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Models\BusinessToCustomerTransaction;
use Softwarescares\Safaricomdaraja\app\Models\MpesaExpressTransaction;

class MPesaExpressTransactionEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MPesaExpressTransactionEvent $event)
    {
        
        MpesaExpressTransaction::create(
            [
                "MerchantRequestID" => $event->result["Body"]["stkCallback"]["MerchantRequestID"],            
                "CheckoutRequestID" => $event->result["Body"]["stkCallback"]["CheckoutRequestID"],            
                "ResultCode" => $event->result["Body"]["stkCallback"]["ResultCode"],            
                "ResultDesc" => $event->result["Body"]["stkCallback"]["ResultDesc"],
                "Amount" =>   isset($event->result["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"])? $event->result["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"] : null,
                "MpesaReceiptNumber" => isset($event->result["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"])? $event->result["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"] : null,
                "TransactionDate" => isset($event->result["Body"]["stkCallback"]["CallbackMetadata"]["Item"][2]["Value"])? $event->result["Body"]["stkCallback"]["CallbackMetadata"]["Item"][2]["Value"]: null,
                "PhoneNumber" => isset($event->result["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"])? $event->result["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"] : null,
                'order_id' => 1
            ]
        );
    }
}
