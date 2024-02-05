<?php

use App\Http\Controllers\Api\RegistroInversionController;
use App\Models\RegistroInversion;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function() {


    //REGISTRO INVERSIONES
    Route::group(['prefix' => 'registro-inversiones'], function(){
        Route::get('/',[RegistroInversionController::class,'index']);
        Route::post('/',[RegistroInversionController::class,'store']);
    });

});
