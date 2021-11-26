<?php

namespace Softwarescares\Safaricomdaraja\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerToBusinessTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "TransactionType",
        "TransID",
        "TransTime",
        "TransAmount",
        "BusinessShortCode",
        "BillRefNumber",
        "InvoiceNumber",
        "OrgAccountBalance",
        "ThirdPartyTransID",
        "MSISDN",
        "FirstName",
        "MiddleName",
        "LastName",
        "order_id"
    ];
}
