<?php

/*** Daraja web routes ***/

use Illuminate\Support\Facades\Route;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\AccountBalanceController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\BusinessToCustomerController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\CustomerToBusinessController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\MpesaExpressController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\TransactionReversalController;

Route::get('/safaricomdaraja', function(){

    return response()->json(['safaricomdaraja running'],200);

});

Route::post("mpesa-express", [MpesaExpressController::class, "mpesaExpress"])->name("mpesaexpress"); //Initiate sstk push transaction request
Route::post("customer-to-business", [CustomerToBusinessController::class, "customerToBusiness"])->name("customertobusiness"); //Initiate Customer To Business transaction request
Route::post("business-to-customer", [BusinessToCustomerController::class, "businessToCustomer"]); //Initiate Business To Customer transaction request

//-- Forms and view Render
Route::get("mpesa-express", [MpesaExpressController::class, "create"]); // Render mpesa express view form
Route::get("customertobusiness", [CustomerToBusinessController::class, "create"]); // Customer to Business view form
Route::get("businesstocustomer", [BusinessToCustomerController::class, "create"]); // Business to Customer view form

//Transactions 

Route::get("mpesa-express-transactions", [MpesaExpressController::class, "transactions"]); // Mpesa express transactions view
Route::get("customer-to-business-transactions", [CustomerToBusinessController::class, "transactions"]); // Customer to busines transactions view
Route::get("business-to-customer-transactions", [BusinessToCustomerController::class, "transactions"]); // Business to Customer transactions view

// All transactions

Route::get("all-transactions", [DarajaController::class, "transactions"]); // Business to Customer transactions view

// Account Balance
Route::get("account-balance", [AccountBalanceController::class, "accountBalance"]); // Render Account Balance form
Route::post("account-balance",[AccountBalanceController::class, "transaction"]); // Initiate account balance transaction

// Trsansaction Reversal 

Route::post("transaction-reversal",[TransactionReversalController::class, "transaction"]); // Initiate transaction reversal
Route::get("transactionreversal",[TransactionReversalController::class, "transactionReversal"]); // render transaction reversal form




