<?php

namespace Softwarescares\Safaricomdaraja\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentTransactionUser extends Model
{
    use HasFactory;

    protected $fillable =[
        "current_transaction_user_id"
    ];
}
