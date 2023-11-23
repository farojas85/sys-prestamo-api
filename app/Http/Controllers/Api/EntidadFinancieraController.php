<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EntidadFinanciera;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class EntidadFinancieraController extends Controller
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
    public function show(EntidadFinanciera $entidadFinanciera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntidadFinanciera $entidadFinanciera)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntidadFinanciera $entidadFinanciera)
    {
        //
    }

    public function obtenerLista()
    {
        $entidad_financieras = EntidadFinanciera::getList();

        $success = JWT::encode(['entidad_financieras'=> $entidad_financieras],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);

    }
}
