<?php

/*** Daraja web routes ***/

use Illuminate\Support\Facades\Route;

Route::get('/safaricomdaraja', function(){

    return response()->json([],200);

});