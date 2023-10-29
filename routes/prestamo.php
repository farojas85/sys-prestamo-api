<?php

use App\Http\Controllers\Api\ClienteController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function(){
    //CLIENTES
    Route::group(['prefix' => 'clientes'], function(){
        Route::get('/',[ClienteController::class,'index']);
        Route::get('actives',[ClienteController::class,'obtenerActivos']);
        Route::get('inactives',[ClienteController::class,'obtenerInactivos']);
        Route::get('list',[ClienteController::class,'obtenerLista']);
        Route::post('/',[ClienteController::class,'store']);
        Route::put('{id}',[ClienteController::class,'update']);
        Route::get('{id}/show',[ClienteController::class,'show']);
        Route::put('{id}/disable',[ClienteController::class,'inhabilitar']);
        Route::put('{id}/enable',[ClienteController::class,'habilitar']);
    });
});
