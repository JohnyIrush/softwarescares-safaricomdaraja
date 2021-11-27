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

        $result = json_decode(json_encode($event->result));

       TransactionReversal::create(
            [
                "ResultType" => $result->Result->ResultType,                     
                "ResultCode" => $result->Result->ResultCode,            
                "ResultDesc" => $result->Result->ResultDesc,
                "OriginatorConversationID" =>   $result->Result->OriginatorConversationID,
                "ConversationID" => $result->Result->ConversationID,
                "TransactionID" => $result->Result->TransactionID,
                "DebitAccountBalance" => isset($result->Result->ResultParameters->ResultParameter[0]->Value)? $result->Result->ResultParameters->ResultParameter[0]->Value: null,
                "Amount" => isset($result->Result->ResultParameters->ResultParameter[1]->Value)? $result->Result->ResultParameters->ResultParameter[1]->Value: null,
                "TransCompletedTime" => isset($result->Result->ResultParameters->ResultParameter[2]->Value)? $result->Result->ResultParameters->ResultParameter[2]->Value: null,
                "OriginalTransactionID" => isset($result->Result->ResultParameters->ResultParameter[3]->Value)?$result->Result->ResultParameters->ResultParameter[3]->Value :null ,
                "Charge" => isset($result->Result->ResultParameters->ResultParameter[4]->Value)? $result->Result->ResultParameters->ResultParameter[4]->Value: null,
                "CreditPartyPublicName" => isset($result->Result->ResultParameters->ResultParameter[5]->Value)? $result->Result->ResultParameters->ResultParameter[5]->Value: null,
                "DebitPartyPublicName" => isset($result->Result->ResultParameters->ResultParameter[6]->Value)? $result->Result->ResultParameters->ResultParameter[6]->Value: null,
                'transaction_id' => 6,
                'transaction_type' => 'c2b'
            ]
            );


    }
}
