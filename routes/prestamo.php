<?php

use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\PrestamoController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function(){
    //CLIENTES
    Route::group(['prefix' => 'clientes'], function(){
        Route::get('/',[ClienteController::class,'index']);
        Route::get('exist',[ClienteController::class,'buscarPorNumeroDocumento']);
        Route::get('actives',[ClienteController::class,'obtenerActivos']);
        Route::get('inactives',[ClienteController::class,'obtenerInactivos']);
        Route::get('list',[ClienteController::class,'obtenerLista']);
        Route::post('/',[ClienteController::class,'store']);
        Route::put('{id}',[ClienteController::class,'update']);
        Route::get('{id}/show',[ClienteController::class,'show']);
        Route::put('{id}/disable',[ClienteController::class,'inhabilitar']);
        Route::put('{id}/enable',[ClienteController::class,'habilitar']);
    });

    //PRESTAMOS
    Route::group(['prefix' => 'prestamos'], function(){
        Route::get('/',[PrestamoController::class,'index']);
        Route::get('all',[PrestamoController::class,'todos']);
        Route::get('deletes',[PrestamoController::class,'eliminados']);
        Route::get('list',[PrestamoController::class,'obtenerLista']);
        Route::post('/',[PrestamoController::class,'store']);
        Route::post('modify-estado',[PrestamoController::class,'modificarEstado']);
        Route::put('{id}',[PrestamoController::class,'update']);
        Route::post('delete-record',[PrestamoController::class,'destroy']);
        Route::get('{id}/show',[PrestamoController::class,'show']);
        Route::put('{id}/disable',[PrestamoController::class,'inhabilitar']);
        Route::put('{id}/enable',[PrestamoController::class,'habilitar']);
        Route::post('subir-contrato',[PrestamoController::class,'subirContrato']);
        Route::get('/by-cliente',[PrestamoController::class,'buscarPorCliente']);
    });
});
