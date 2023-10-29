<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sexo;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class SexoController extends Controller
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
    public function show(Sexo $sexo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sexo $sexo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sexo $sexo)
    {
        //
    }

    /**
     * obtener Lista
     * @return [type]
     */
    public function obtenerLista()
    {
        $sexos = Sexo::getList();

        $success = JWT::encode(['sexos'=> $sexos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
}
