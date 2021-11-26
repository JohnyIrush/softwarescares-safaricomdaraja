<?php

namespace Softwarescares\Safaricomdaraja\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MpesaExpressTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "MerchantRequestID",             
        "CheckoutRequestID",             
        "ResultCode",       
        "ResultDesc", 
        "Amount",
        "MpesaReceiptNumber", 
        "TransactionDate", 
        "PhoneNumber", 
        'order_id', 
    ];
}
