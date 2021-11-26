<?php

namespace Softwarescares\Safaricomdaraja\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessToCustomerTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "ResultType",                     
        "ResultCode",            
        "ResultDesc",
        "OriginatorConversationID",
        "ConversationID",
        "TransactionID",
        "TransactionAmount",
        "TransactionReceipt",
        "TransactionReceipt",
        "B2CRecipientIsRegisteredCustomer",
        "B2CChargesPaidAccountAvailableFunds",
        "ReceiverPartyPublicName",
        "TransactionCompletedDateTime",
        "B2CUtilityAccountAvailableFunds",
        'order_id'
    ];
}
