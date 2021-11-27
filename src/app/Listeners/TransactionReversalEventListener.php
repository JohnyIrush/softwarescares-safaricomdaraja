<?php

namespace Softwarescares\Safaricomdaraja\app\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Softwarescares\Safaricomdaraja\app\Events\BusinessToCustomerTransactionEvent;
use Softwarescares\Safaricomdaraja\app\Events\TransactionReversalEvent;
use Softwarescares\Safaricomdaraja\app\Models\BusinessToCustomerTransaction;
use Softwarescares\Safaricomdaraja\app\Models\TransactionReversal;

class TransactionReversalEventListener
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
    public function handle(TransactionReversalEvent $event)
    {
        Log::info("TransactionReversalEventListener");

       TransactionReversal::create(
            [
                "ResultType" => $event->result->Result->ResultType,                     
                "ResultCode" => $event->result->Result->ResultCode,            
                "ResultDesc" => $event->result->Result->ResultDesc,
                "OriginatorConversationID" =>   $event->result->Result->OriginatorConversationID,
                "ConversationID" => $event->result->Result->ConversationID,
                "TransactionID" => $event->result->Result->TransactionID,
                "DebitAccountBalance" => isset($event->result->Result->ResultParameters->ResultParameter[0]->Value)? $event->result->Result->ResultParameters->ResultParameter[0]->Value: null,
                "Amount" => isset($event->result->Result->ResultParameters->ResultParameter[1]->Value)? $event->result->Result->ResultParameters->ResultParameter[1]->Value: null,
                "TransCompletedTime" => isset($event->result->Result->ResultParameters->ResultParameter[2]->Value)? $event->result->Result->ResultParameters->ResultParameter[2]->Value: null,
                "OriginalTransactionID" => isset($event->result->Result->ResultParameters->ResultParameter[3]->Value)?$event->result->Result->ResultParameters->ResultParameter[3]->Value :null ,
                "Charge" => isset($event->result->Result->ResultParameters->ResultParameter[4]->Value)? $event->result->Result->ResultParameters->ResultParameter[4]->Value: null,
                "CreditPartyPublicName" => isset($event->result->Result->ResultParameters->ResultParameter[5]->Value)? $event->result->Result->ResultParameters->ResultParameter[5]->Value: null,
                "DebitPartyPublicName" => isset($event->result->Result->ResultParameters->ResultParameter[6]->Value)? $event->result->Result->ResultParameters->ResultParameter[6]->Value: null,
                'transaction_id' => 6,
                'transaction_type' => 'c2b'
            ]
            );


    }
}
