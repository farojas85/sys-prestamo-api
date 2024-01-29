<?php

use App\Http\Controllers\Api\RegistroInversionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function() {
    //INVERSIONES

    Route::group(['prefix' => 'inversiones'], function(){
        Route::get('/',[RegistroInversionController::class,'index']);
    });

    //REGISTRO INVERSIONES
    Route::group(['prefix' => 'registro-inversiones'], function(){

    });

});
