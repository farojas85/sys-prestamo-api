<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoDocumento;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
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
    public function show(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * obtener Lista
     * @return [type]
     */
    public function obtenerLista()
    {
        $tipo_documentos = TipoDocumento::getList();

        $success = JWT::encode(['tipo_documentos'=> $tipo_documentos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
}
