<?php

use App\Http\Controllers\Api\TipoAccesoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function(){
    //TIPO ACCESOS
    Route::group(['prefix' => 'tipo-accesos'], function(){
        Route::get('/',[TipoAccesoController::class,'index']);
        Route::get('deleted',[TipoAccesoController::class,'obtenerEliminados']);
        Route::get('all',[TipoAccesoController::class,'obtenerTodos']);
        Route::get('actives',[TipoAccesoController::class,'obtenerActivos']);
        Route::get('inactives',[TipoAccesoController::class,'obtenerInactivos']);
        Route::post('/',[TipoAccesoController::class,'store']);
        Route::put('{id}',[TipoAccesoController::class,'update']);
        Route::get('{id}',[TipoAccesoController::class,'show']);
        Route::put('{id}/disable',[TipoAccesoController::class,'inhabilitar']);
        Route::put('{id}/enable',[TipoAccesoController::class,'habilitar']);
    });
    //USUARIOS
    Route::group(['prefix' => 'users'], function(){
        Route::get('data',[UserController::class,'mostrarDatosUsuario']);
    });
});
