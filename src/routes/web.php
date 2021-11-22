<?php

/*** Daraja web routes ***/

use Illuminate\Support\Facades\Route;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\MpesaExpressController;

Route::get('/safaricomdaraja', function(){

    return response()->json(['safaricomdaraja running'],200);

});

Route::post("mpesa-express", [MpesaExpressController::class, "mpesaExpress"])->name("mpesaexpress"); //Initiate sstk push transaction request
Route::post("customer-to-business", [MpesaExpressController::class, "customerToBusiness"]); //Initiate Customer To Business transaction request
Route::post("business-to-customer", [MpesaExpressController::class, "businessToCustomer"]); //Initiate Business To Customer transaction request

//-- Forms and view Render
Route::get("mpesa-express", [MpesaExpressController::class, "create"]); // Render mpesa express view form
