<?php

use App\Http\Controllers\Api\FrecuenciaPagoController;
use App\Http\Controllers\Api\AplicacionInteresController;
use App\Http\Controllers\Api\AplicacionMoraController;
use App\Http\Controllers\Api\MonedaController;
use App\Http\Controllers\Api\SexoController;
use App\Http\Controllers\Api\TipoDocumentoController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function(){
    //FRECUENCIA PAGOS
    Route::group(['prefix' => 'frecuencia-pagos'], function(){
        Route::get('/',[FrecuenciaPagoController::class,'index']);
        Route::get('actives',[FrecuenciaPagoController::class,'obtenerActivos']);
        Route::get('inactives',[FrecuenciaPagoController::class,'obtenerInactivos']);
        Route::post('/',[FrecuenciaPagoController::class,'store']);
        Route::put('{id}',[FrecuenciaPagoController::class,'update']);
        Route::get('{id}/show',[FrecuenciaPagoController::class,'show']);
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
        Route::get('{id}/show',[AplicacionInteresController::class,'show']);
        Route::put('{id}/disable',[AplicacionInteresController::class,'inhabilitar']);
        Route::put('{id}/enable',[AplicacionInteresController::class,'habilitar']);
        Route::get('list',[AplicacionInteresController::class,'obtenerLista']);
    });

    //APLICACIÓN MORAS
    Route::group(['prefix' => 'aplicacion-moras'], function(){
        Route::get('/',[AplicacionMoraController::class,'index']);
        Route::get('actives',[AplicacionMoraController::class,'obtenerActivos']);
        Route::get('inactives',[AplicacionMoraController::class,'obtenerInactivos']);
        Route::post('/',[AplicacionMoraController::class,'store']);
        Route::put('{id}',[AplicacionMoraController::class,'update']);
        Route::get('{id}/show',[AplicacionMoraController::class,'show']);
        Route::put('{id}/disable',[AplicacionMoraController::class,'inhabilitar']);
        Route::put('{id}/enable',[AplicacionMoraController::class,'habilitar']);
        Route::get('list',[AplicacionMoraController::class,'obtenerLista']);
    });

    //MONEDAS
    Route::group(['prefix' => 'monedas'], function(){
        Route::get('/',[MonedaController::class,'index']);
        Route::get('actives',[MonedaController::class,'obtenerActivos']);
        Route::get('inactives',[MonedaController::class,'obtenerInactivos']);
        Route::post('/',[MonedaController::class,'store']);
        Route::put('{id}',[MonedaController::class,'update']);
        Route::get('{id}',[MonedaController::class,'show']);
        Route::put('{id}/disable',[MonedaController::class,'inhabilitar']);
        Route::put('{id}/enable',[MonedaController::class,'habilitar']);
        Route::get('list',[MonedaController::class,'obtenerLista']);
    });

    //TIPO DOCUMENTOS
    Route::group(['prefix' => 'tipo-documentos'], function(){
        // Route::get('/',[TipoDocumentoController::class,'index']);
        // Route::get('actives',[TipoDocumentoController::class,'obtenerActivos']);
        // Route::get('inactives',[TipoDocumentoController::class,'obtenerInactivos']);
        // Route::post('/',[TipoDocumentoController::class,'store']);
        // Route::put('{id}',[TipoDocumentoController::class,'update']);
        // Route::get('{id}',[TipoDocumentoController::class,'show']);
        // Route::put('{id}/disable',[TipoDocumentoController::class,'inhabilitar']);
        // Route::put('{id}/enable',[TipoDocumentoController::class,'habilitar']);
        Route::get('list',[TipoDocumentoController::class,'obtenerLista']);
    });

    //SEXOS
    Route::group(['prefix' => 'sexos'], function(){
        // Route::get('/',[TipoDocumentoController::class,'index']);
        // Route::get('actives',[TipoDocumentoController::class,'obtenerActivos']);
        // Route::get('inactives',[TipoDocumentoController::class,'obtenerInactivos']);
        // Route::post('/',[TipoDocumentoController::class,'store']);
        // Route::put('{id}',[TipoDocumentoController::class,'update']);
        // Route::get('{id}',[TipoDocumentoController::class,'show']);
        // Route::put('{id}/disable',[TipoDocumentoController::class,'inhabilitar']);
        // Route::put('{id}/enable',[TipoDocumentoController::class,'habilitar']);
        Route::get('list',[SexoController::class,'obtenerLista']);
    });
});
