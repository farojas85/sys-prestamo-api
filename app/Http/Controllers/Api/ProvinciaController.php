<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provincia;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
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
    public function show(Provincia $provincia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provincia $provincia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provincia $provincia)
    {
        //
    }

    public function obtenerLista()
    {
        $provincias = Provincia::getList();

        $success = JWT::encode(['provincias'=> $provincias],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function obtenerListaPorDepartamento(Request $request)
    {
        $provincias = Provincia::getbyDepartamentoId($request->departamento_id);

        $success = JWT::encode(['provincias'=> $provincias],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
}
