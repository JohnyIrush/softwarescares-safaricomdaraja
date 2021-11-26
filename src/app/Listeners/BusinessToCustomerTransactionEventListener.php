<?php

namespace Softwarescares\Safaricomdaraja\app\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Events\BusinessToCustomerTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Models\BusinessToCustomerTransaction;

class BusinessToCustomerTransactionEventListener
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
    public function handle(BusinessToCustomerTransactionEvent $event)
    {
        Log::info("BusinessToCustomerTransactionEvent ");

        BusinessToCustomerTransaction::create(
            [
                "ResultType" => $event->result->Result->ResultType,                     
                "ResultCode" => $event->result->Result->ResultCode,            
                "ResultDesc" => $event->result->Result->ResultDesc,
                "OriginatorConversationID" =>   $event->result->Result->OriginatorConversationID,
                "ConversationID" => $event->result->Result->ConversationID,
                "TransactionID" => $event->result->Result->TransactionID,
                "TransactionAmount" =>  isset($event->result->Result->ResultParameters->ResultParameter[0]->Value)? $event->result->Result->ResultParameters->ResultParameter[0]->Value : null,
                "TransactionReceipt" =>  isset($event->result->Result->ResultParameters->ResultParameter[1]->Value)?$event->result->Result->ResultParameters->ResultParameter[1]->Value : null,
                "TransactionReceipt" =>  isset($event->result->Result->ResultParameters->ResultParameter[2]->Value)?$event->result->Result->ResultParameters->ResultParameter[2]->Value : null,
                "B2CRecipientIsRegisteredCustomer" =>  isset($event->result->Result->ResultParameters->ResultParameter[3]->Value)?$event->result->Result->ResultParameters->ResultParameter[3]->Value : null,
                "B2CChargesPaidAccountAvailableFunds" => isset($event->result->Result->ResultParameters->ResultParameter[4]->Value )?$event->result->Result->ResultParameters->ResultParameter[4]->Value : null,
                "ReceiverPartyPublicName" =>  isset($event->result->Result->ResultParameters->ResultParameter[5]->Value)?$event->result->Result->ResultParameters->ResultParameter[5]->Value : null,
                "TransactionCompletedDateTime" =>  isset($event->result->Result->ResultParameters->ResultParameter[6]->Value)?$event->result->Result->ResultParameters->ResultParameter[6]->Value : null,
                "B2CUtilityAccountAvailableFunds" =>  isset($event->result->Result->ResultParameters->ResultParameter[7]->Value)?$event->result->Result->ResultParameters->ResultParameter[7]->Value : null,
                'order_id' => 1
            ]
        );
    }
}
