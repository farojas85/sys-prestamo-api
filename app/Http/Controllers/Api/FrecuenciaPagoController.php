<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrecuenciaPago\StoreFrecuenciaPagoRequest;
use App\Http\Requests\FrecuenciaPago\UpdateFrecuenciaPagoRequest;
use App\Models\FrecuenciaPago;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class FrecuenciaPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     *
     * @return encrypt array
     */
    public function index(Request $request)
    {
        $frecuencia_pagos = FrecuenciaPago::getAll($request);

        $success = JWT::encode(['frecuencia_pagos'=> $frecuencia_pagos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Display a pagination listing of the resource
     * @param Request $request
     *
     * @return encrypt array
     */
    public function obtenerActivos(Request $request)
    {
        $frecuencia_pagos = FrecuenciaPago::getActives($request);

        $success = JWT::encode(['frecuencia_pagos'=> $frecuencia_pagos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Display a pagination listing of the resource
     * @param Request $request
     *
     * @return encrypt array
     */
    public function obtenerInactivos(Request $request)
    {
        $frecuencia_pagos = FrecuenciaPago::getInactives($request);

        $success = JWT::encode(['frecuencia_pagos'=> $frecuencia_pagos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function obtenerLista()
    {
        $frecuencia_pagos = FrecuenciaPago::getList();

        $success = JWT::encode(['frecuencia_pagos'=> $frecuencia_pagos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFrecuenciaPagoRequest $request)
    {
        $request->validated();

        $frecuencia_pago = FrecuenciaPago::storeData($request);

        $success = JWT::encode($frecuencia_pago,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $frecuencia_pago = FrecuenciaPago::find($id);

        $success = JWT::encode(['frecuencia_pago'=>$frecuencia_pago],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFrecuenciaPagoRequest $request, int $id)
    {
        $request->validated();

        $frecuencia_pago = FrecuenciaPago::updateData($request,$id);

        $success = JWT::encode($frecuencia_pago,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FrecuenciaPago $FrecuenciaPago)
    {
        //
    }

    /**
     * Disable the specified resource in storage
     * @param int $id
     *
     * @return [type]
     */
    public function inhabilitar(int $id)
    {
        $frecuencia_pago = FrecuenciaPago::disableRecord($id);

        $success = JWT::encode($frecuencia_pago,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * enable the specified resource in storage
     * @param int $id
     *
     * @return [type]
     */
    public function habilitar(int $id)
    {
        $frecuencia_pago = FrecuenciaPago::enableRecord($id);

        $success = JWT::encode($frecuencia_pago,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
