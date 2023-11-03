<?php

use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\PersonaController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function(){
    //PERSONAS
    Route::group(['prefix' => 'personas'], function(){
        Route::get('/dni/{numeroDocumento}',[PersonaController::class,'buscarDatosDni']);
    });

    //EMPLEADOS
    Route::group(['prefix' => 'empleados'], function(){
        Route::get('/',[EmpleadoController::class,'index']);
        Route::get('actives',[EmpleadoController::class,'obtenerActivos']);
        Route::get('inactives',[EmpleadoController::class,'obtenerInactivos']);
        Route::get('list',[EmpleadoController::class,'obtenerLista']);
        Route::post('/',[EmpleadoController::class,'store']);
        Route::put('{id}',[EmpleadoController::class,'update']);
        Route::get('{id}/show',[EmpleadoController::class,'show']);
        Route::put('{id}/disable',[EmpleadoController::class,'inhabilitar']);
        Route::put('{id}/enable',[EmpleadoController::class,'habilitar']);
    });
});