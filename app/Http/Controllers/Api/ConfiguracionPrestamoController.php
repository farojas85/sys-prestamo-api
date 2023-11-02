<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConfiguracionPrestamo;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class ConfiguracionPrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $configuracionPrestamo = ConfiguracionPrestamo::storeData($request);

        $success = JWT::encode($configuracionPrestamo,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ConfiguracionPrestamo $configuracionPrestamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConfiguracionPrestamo $configuracionPrestamo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConfiguracionPrestamo $configuracionPrestamo)
    {
        //
    }
}
