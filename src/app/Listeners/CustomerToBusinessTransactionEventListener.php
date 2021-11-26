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
       CustomerToBusinessTransaction::create(
            [
                "TransactionType" => $event->result->TransactionType,
                "TransID" => $event->result->TransID,
                "TransTime" => $event->result->TransTime,
                "TransAmount" => $event->result->TransAmount,
                "BusinessShortCode" => $event->result->BusinessShortCode,
                "BillRefNumber" => $event->result->BillRefNumber,
                "InvoiceNumber" => $event->result->InvoiceNumber,
                "OrgAccountBalance" => $event->result->OrgAccountBalance,
                "ThirdPartyTransID" =>$event->result->ThirdPartyTransID ,
                "MSISDN" => $event->result->MSISDN,
                "FirstName" => $event->result->FirstName,
                "MiddleName" => $event->result->MiddleName,
                "LastName" => $event->result->LastName,
                "order_id" => 2
            ]
        );
    }
}
