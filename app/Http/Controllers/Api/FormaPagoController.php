<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FormaPago;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class FormaPagoController extends Controller
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
    public function show(FormaPago $formaPago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FormaPago $formaPago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormaPago $formaPago)
    {
        //
    }

     /**
     * obtener Lista
     * @return [type]
     */
    public function obtenerLista()
    {
        $forma_pagos = FormaPago::getList();

        $success = JWT::encode(['forma_pagos'=> $forma_pagos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
}
