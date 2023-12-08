<?php

use App\Http\Controllers\Api\FormaPagoController;
use App\Http\Controllers\Api\MedioPagoController;
use App\Http\Controllers\Api\RegistroPagoController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function() {
    //FORMA PAGOS
    Route::group(['prefix' => 'forma-pagos'], function(){
        Route::get('list',[FormaPagoController::class,'obtenerLista']);
    });

    //MEDIO PAGOS
    Route::group(['prefix' => 'medio-pagos'], function(){
        Route::get('list-by-forma-pago',[MedioPagoController::class,'listarPorFormaPago']);
    });

    //REGISTRO PAGOS
    Route::group(['prefix' => 'registro-pagos'], function(){
        Route::post('/',[RegistroPagoController::class,'store']);
        Route::get('/buscar-clientes',[RegistroPagoController::class,'buscarClientes']);
        Route::get('all-pagination',[RegistroPagoController::class,'obtenerTodosPaginacion']);
        Route::get('data',[RegistroPagoController::class,'obtenerDatosRegistroPago']);
        Route::post('aceptar-pago',[RegistroPagoController::class,'aceptarPago']);
    });
});
