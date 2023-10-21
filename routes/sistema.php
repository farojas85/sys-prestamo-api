<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' > ['auth:sanctum']],function(){
    //USUARIOS
    Route::group(['prefix' => 'users'], function(){
        Route::get('data',[UserController::class,'mostrarDatosUsuario']);
    });
});
