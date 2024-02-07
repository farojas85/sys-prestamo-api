<?php

use App\Http\Controllers\Api\RegistroInversionController;
use App\Models\RegistroInversion;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function() {


    //REGISTRO INVERSIONES
    Route::group(['prefix' => 'registro-inversiones'], function(){
        Route::get('/',[RegistroInversionController::class,'index']);
        Route::post('/',[RegistroInversionController::class,'store']);
        Route::get('show',[RegistroInversionController::class,'show']);
        Route::post('update',[RegistroInversionController::class,'update']);
        Route::post('delete',[RegistroInversionController::class,'destroy']);
        Route::get('data-dashboard',[RegistroInversionController::class,'obtenerDatosInversionesUsuario']);
    });

});
