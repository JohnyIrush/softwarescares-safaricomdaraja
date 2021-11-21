<?php

/*** Package api routes ***/

use Illuminate\Support\Facades\Route;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\BusinessToCustomerController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\CustomerToBusinessController;
use Softwarescares\Safaricomdaraja\app\Http\Controllers\DarajaProvider\MpesaExpressController;

Route::post("mpesaexpress/result",[MpesaExpressController::class, "result"]);
Route::post("customertobusiness/result",[CustomerToBusinessController::class, "result"]);
Route::post("businesstocustomer/result",[BusinessToCustomerController::class, "result"]);