<?php

use App\Http\Controllers\Api\RegistroPagoController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function(){
    //REGISTRO PAGOS

    Route::group(['prefix' => 'registro-pagos'], function(){
        Route::get('/buscar-clientes',[RegistroPagoController::class,'buscarClientes']);
    });
});
