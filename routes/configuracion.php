<?php

use App\Http\Controllers\Api\FrecuenciaPagoController;
use App\Http\Controllers\Api\AplicacionInteresController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function(){
    //FRECUENCIA PAGOS
    Route::group(['prefix' => 'frecuencia-pagos'], function(){
        Route::get('/',[FrecuenciaPagoController::class,'index']);
        Route::get('actives',[FrecuenciaPagoController::class,'obtenerActivos']);
        Route::get('inactives',[FrecuenciaPagoController::class,'obtenerInactivos']);
        Route::post('/',[FrecuenciaPagoController::class,'store']);
        Route::put('{id}',[FrecuenciaPagoController::class,'update']);
        Route::get('{id}',[FrecuenciaPagoController::class,'show']);
        Route::put('{id}/disable',[FrecuenciaPagoController::class,'inhabilitar']);
        Route::put('{id}/enable',[FrecuenciaPagoController::class,'habilitar']);
        Route::get('list',[FrecuenciaPagoController::class,'obtenerLista']);
    });

    //APLICACIÓN INTERESES
    Route::group(['prefix' => 'aplicacion-intereses'], function(){
        Route::get('/',[AplicacionInteresController::class,'index']);
        Route::get('actives',[AplicacionInteresController::class,'obtenerActivos']);
        Route::get('inactives',[AplicacionInteresController::class,'obtenerInactivos']);
        Route::post('/',[AplicacionInteresController::class,'store']);
        Route::put('{id}',[AplicacionInteresController::class,'update']);
        Route::get('{id}',[AplicacionInteresController::class,'show']);
        Route::put('{id}/disable',[AplicacionInteresController::class,'inhabilitar']);
        Route::put('{id}/enable',[AplicacionInteresController::class,'habilitar']);
        Route::get('list',[AplicacionInteresController::class,'obtenerLista']);
    });
});
