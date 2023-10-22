<?php

use App\Http\Controllers\Api\FrecuenciaPagoController;
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
});
