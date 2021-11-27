<?php

namespace Softwarescares\Safaricomdaraja\app\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Events\CustomerToBusinessTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Models\CustomerToBusinessTransaction;

class CustomerToBusinessTransactionEventListener
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
    public function handle(CustomerToBusinessTransactionEvent $event)
    {
       Log::info("CustomerToBusinessTransactionEventListener");
       Log::info(json_encode($event->result));

       $result = json_decode(json_encode($event->result));

       CustomerToBusinessTransaction::create(
            [
                "TransactionType" => $result->TransactionType,
                "TransID" => $result->TransID,
                "TransTime" => $result->TransTime,
                "TransAmount" => $result->TransAmount,
                "BusinessShortCode" => $result->BusinessShortCode,
                "BillRefNumber" => $result->BillRefNumber,
                "InvoiceNumber" => $result->InvoiceNumber,
                "OrgAccountBalance" => $result->OrgAccountBalance,
                "ThirdPartyTransID" =>$result->ThirdPartyTransID ,
                "MSISDN" => $result->MSISDN,
                "FirstName" => $result->FirstName,
                "MiddleName" => $result->MiddleName,
                "LastName" => $result->LastName,
                "order_id" => 2
            ]
        );
    }
}
