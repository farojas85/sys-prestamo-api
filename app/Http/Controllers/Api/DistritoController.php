<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Distrito;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class DistritoController extends Controller
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
    public function show(Distrito $distrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distrito $distrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distrito $distrito)
    {
        //
    }

    public function obtenerLista()
    {
        $distritos = Distrito::getList();

        $success = JWT::encode(['distritos'=> $distritos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function obtenerListaPorProvincia(Request $request)
    {
        $distritos = Distrito::getbyProvinciaId($request->provincia_id);

        $success = JWT::encode(['distritos'=> $distritos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
}
