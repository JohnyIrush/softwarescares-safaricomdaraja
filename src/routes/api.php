<?php

/*** Package api routes ***/

use Illuminate\Support\Facades\Route;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\BusinessToCustomerController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\CustomerToBusinessController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\MpesaExpressController;

use Illuminate\Http\Request;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\AccountBalanceController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\TransactionStatusController;

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

//account balance
Route::post("accountbalance/queue-timeout",[AccountBalanceController::class, "queueTimeOutURL"]);
Route::post("accountbalance/result",[AccountBalanceController::class, "result"]);

//account balance
Route::post("reversal/queue-timeout",[AccountBalanceController::class, "queueTimeOutURL"]);
Route::post("reversal/result",[AccountBalanceController::class, "result"]);

//Transaction Status
Route::post("transaction-status/queue-timeout",[TransactionStatusController::class, "queueTimeOutURL"]);
Route::post("transaction-status/result",[TransactionStatusController::class, "result"]);