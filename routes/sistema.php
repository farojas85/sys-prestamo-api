<?php

use App\Http\Controllers\Api\RoleController;
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
        Route::get('list',[TipoAccesoController::class,'obtenerLista']);
        Route::post('/',[TipoAccesoController::class,'store']);
        Route::put('{id}',[TipoAccesoController::class,'update']);
        Route::get('{id}',[TipoAccesoController::class,'show']);
        Route::put('{id}/disable',[TipoAccesoController::class,'inhabilitar']);
        Route::put('{id}/enable',[TipoAccesoController::class,'habilitar']);
    });

    //ROLES
    Route::group(['prefix' => 'roles'], function(){
        Route::get('/',[RoleController::class,'index']);
        Route::get('deleted',[RoleController::class,'obtenerEliminados']);
        Route::get('all',[RoleController::class,'obtenerTodos']);
        Route::get('actives',[RoleController::class,'obtenerActivos']);
        Route::get('inactives',[RoleController::class,'obtenerInactivos']);
        Route::post('/',[RoleController::class,'store']);
        Route::put('{id}',[RoleController::class,'update']);
        Route::get('{id}',[RoleController::class,'show']);
        Route::put('{id}/disable',[RoleController::class,'inhabilitar']);
        Route::put('{id}/enable',[RoleController::class,'habilitar']);
    });

    //USUARIOS
    Route::group(['prefix' => 'users'], function(){
        Route::get('data',[UserController::class,'mostrarDatosUsuario']);
    });
});
