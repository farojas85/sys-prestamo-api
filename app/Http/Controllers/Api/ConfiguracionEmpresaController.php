<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ConfiguracionEmpresa;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class ConfiguracionEmpresaController extends Controller
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
        $configuracion_empresa = ConfiguracionEmpresa::storeData($request);

        $success = JWT::encode($configuracion_empresa,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ConfiguracionEmpresa $configuracionEmpresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConfiguracionEmpresa $configuracionEmpresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConfiguracionEmpresa $configuracionEmpresa)
    {
        //
    }

    public function obtenerDatos()
    {
        $configuracion_empresa = ConfiguracionEmpresa::getData();
        $success = JWT::encode(['configuracion_empresa' => $configuracion_empresa],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
