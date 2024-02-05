<?php

use App\Http\Controllers\Api\ConfiguracionEmpresaController;
use App\Http\Controllers\Api\ConfiguracionPrestamoController;
use App\Http\Controllers\Api\TipoConfiguracionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function(){
    //TIPO CONFIGURACIONES
    Route::group(['prefix' => 'tipo-configuraciones'], function(){
        //Route::get('/',[TipoConfiguracionController::class,'index']);
        Route::get('todos',[TipoConfiguracionController::class,'obtenerTodos']);
    });

    //CONFIGURACION PRESTAMOS
    Route::group(['prefix' => 'configuracion-prestamos'], function(){
        Route::post('/',[ConfiguracionPrestamoController::class,'store']);
        Route::get('/by-tipo-configuracion',[ConfiguracionPrestamoController::class,'obtenerConfiguracion']);
    });

    //CONFIGURACION EMPRESAS
    Route::group(['prefix' => 'configuracion-empresas'], function(){
        Route::get('/data',[ConfiguracionEmpresaController::class,'obtenerDatos']);
        Route::post('/',[ConfiguracionEmpresaController::class,'store']);
    });
});
