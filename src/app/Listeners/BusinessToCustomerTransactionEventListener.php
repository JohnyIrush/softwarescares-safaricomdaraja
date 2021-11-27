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

        $result = json_decode(json_encode($event->result));
    

        BusinessToCustomerTransaction::create(
            [
                "ResultType" => $result->Result->ResultType,                     
                "ResultCode" => $result->Result->ResultCode,            
                "ResultDesc" => $result->Result->ResultDesc,
                "OriginatorConversationID" =>   $result->Result->OriginatorConversationID,
                "ConversationID" => $result->Result->ConversationID,
                "TransactionID" => $result->Result->TransactionID,
                "TransactionAmount" => isset($result->Result->ResultParameters->ResultParameter[0]->Value)? $result->Result->ResultParameters->ResultParameter[0]->Value: null,
                "TransactionReceipt" => isset($result->Result->ResultParameters->ResultParameter[1]->Value)? $result->Result->ResultParameters->ResultParameter[1]->Value: null,
                "B2CWorkingAccountAvailableFunds" => isset($result->Result->ResultParameters->ResultParameter[7]->Value)? $result->Result->ResultParameters->ResultParameter[7]->Value:null ,
                "B2CRecipientIsRegisteredCustomer" => isset($result->Result->ResultParameters->ResultParameter[2]->Value)? :null ,
                "B2CChargesPaidAccountAvailableFunds" => isset($result->Result->ResultParameters->ResultParameter[3]->Value)? $result->Result->ResultParameters->ResultParameter[3]->Value: null,
                "ReceiverPartyPublicName" => isset($result->Result->ResultParameters->ResultParameter[4]->Value)? $result->Result->ResultParameters->ResultParameter[4]->Value: null,
                "TransactionCompletedDateTime" => isset($result->Result->ResultParameters->ResultParameter[5]->Value)? $result->Result->ResultParameters->ResultParameter[5]->Value: null,
                "B2CUtilityAccountAvailableFunds" => isset($result->Result->ResultParameters->ResultParameter[6]->Value)? $result->Result->ResultParameters->ResultParameter[6]->Value: null,
                'order_id' => 2
            ]
        );
    }
}
