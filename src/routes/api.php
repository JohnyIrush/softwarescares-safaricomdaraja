<?php

/*** Package api routes ***/

use Illuminate\Support\Facades\Route;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\BusinessToCustomerController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\CustomerToBusinessController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\MpesaExpressController;

use Illuminate\Http\Request;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaController;

Route::post("mpesaexpress/result",[MpesaExpressController::class, "result"]);

Route::post("customertobusiness/validation",[CustomerToBusinessController::class, "validation"]);
Route::post("customertobusiness/confirmation",[CustomerToBusinessController::class, "confirmation"]);

Route::post("businesstocustomer/result",[BusinessToCustomerController::class, "result"]);

/** API Proxy to send notification
 *  incase the payment request is 
 * timed out while awaiting 
 * processing in the queue.  
 */
Route::post("businesstocustomer/queue-timeout",[BusinessToCustomerController::class, "queueTimeOutURL"]);

// Transaction result notification

Route::get("transaction/result/notification",[DarajaController::class, "transactionResultNotification"]);
Route::post("transaction/result/notification/read",[DarajaController::class, "readTransactionNotification"]);