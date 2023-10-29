<?php

use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\PermisoController;
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
        Route::get('list',[RoleController::class,'obtenerLista']);
        Route::post('/',[RoleController::class,'store']);
        Route::put('{id}',[RoleController::class,'update']);
        Route::get('{id}/show',[RoleController::class,'show']);
        Route::put('{id}/disable',[RoleController::class,'inhabilitar']);
        Route::put('{id}/enable',[RoleController::class,'habilitar']);
    });

    //MENÚS
    Route::group(['prefix' => 'menus'], function(){
        Route::get('/',[MenuController::class,'index']);
        Route::get('deleted',[MenuController::class,'obtenerEliminados']);
        Route::get('all',[MenuController::class,'obtenerTodos']);
        Route::get('actives',[MenuController::class,'obtenerActivos']);
        Route::get('inactives',[MenuController::class,'obtenerInactivos']);
        Route::get('parents',[MenuController::class,'obtenerPadres']);
        Route::post('/',[MenuController::class,'store']);
        Route::put('{id}',[MenuController::class,'update']);
        Route::get('{id}',[MenuController::class,'show']);
        Route::put('{id}/disable',[MenuController::class,'inhabilitar']);
        Route::put('{id}/enable',[MenuController::class,'habilitar']);
    });

    //PERMISOS
    Route::group(['prefix' => 'permisos'], function(){
        Route::get('/',[PermisoController::class,'index']);
        Route::get('deleted',[PermisoController::class,'obtenerEliminados']);
        Route::get('all',[PermisoController::class,'obtenerTodos']);
        Route::get('actives',[PermisoController::class,'obtenerActivos']);
        Route::get('inactives',[PermisoController::class,'obtenerInactivos']);
        Route::post('/',[PermisoController::class,'store']);
        Route::put('{id}',[PermisoController::class,'update']);
        Route::get('{id}',[PermisoController::class,'show']);
        Route::put('{id}/disable',[PermisoController::class,'inhabilitar']);
        Route::put('{id}/enable',[PermisoController::class,'habilitar']);
    });

    //USUARIOS
    Route::group(['prefix' => 'users'], function(){
        Route::get('data',[UserController::class,'mostrarDatosUsuario']);
    });
});
