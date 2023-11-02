<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoConfiguracion;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoConfiguracionController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoConfiguracion $tipoConfiguracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoConfiguracion $tipoConfiguracion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoConfiguracion $tipoConfiguracion)
    {
        //
    }

    /**
     * obtener all data for configuraciones
     * @return [type]
     */
    public function obtenerTodos()
    {
        $tipo_configuraciones = TipoConfiguracion::getAll();

        $success = JWT::encode(['tipo_configuraciones'=> $tipo_configuraciones],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
}
