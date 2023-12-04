<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedioPago;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class MedioPagoController extends Controller
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
    public function show(MedioPago $medioPago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedioPago $medioPago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedioPago $medioPago)
    {
        //
    }

    public function listarPorFormaPago(Request $request)
    {
        $medio_pagos = MedioPago::getListByFormaPago($request->forma_pago);

        $success = JWT::encode(['medio_pagos'=> $medio_pagos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);

    }
}
