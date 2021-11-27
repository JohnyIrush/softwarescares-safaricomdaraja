<?php

namespace Softwarescares\Safaricomdaraja\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionReversal extends Model
{
    use HasFactory;

    protected $fillable = [
        "ResultType",                     
        "ResultCode",            
        "ResultDesc",
        "OriginatorConversationID",
        "ConversationID",
        "TransactionID",
        "DebitAccountBalance",
        "Amount",
        "TransCompletedTime",
        "OriginalTransactionID",
        "Charge",
        "CreditPartyPublicName",
        "DebitPartyPublicName",
        "transaction_id",
        "transaction_type",
    ];


    /**
     * Get customer to business transaction associated with the TransactionReversal.
     */
    public function customertobusinesstransaction()
    {
        return $this->hasOne(CustomerToBusinessTransaction::class);
    }

    /**
     * Get business to customer transaction associated with the TransactionReversal.
     */
    public function businesstocustomertransaction()
    {
        return $this->hasOne(BusinessToCustomerTransaction::class);
    }
}
