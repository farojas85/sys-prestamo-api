<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistroPago\StoreRegistroPagoRequest;
use App\Models\Cliente;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Models\RegistroPago;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegistroPagoController extends Controller
{
    private $cliente_model;

    public function __construct()
    {
        $this->cliente_model = new Cliente();
    }
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
        if (!$request->forma_pago && !$request->medio_pago)
        {
            $validar = Validator::make(
                $request->all(),[
                    'forma_pago' => 'required',
                    'medio_pago' => 'required',
                    'detalles.*' => 'required'
                ], [
                    'required' => '* Campo obligatorio'
                ]
            );

            if($validar->fails())
            {
                return response()->json($validar->errors(),422);
            }
        }
        if($request->forma_pago != 1)
        {
            $validar = Validator::make(
                $request->all(),[
                    'forma_pago' => 'required',
                    'medio_pago' => 'required',
                    'fecha_deposito' => 'required',
                    'imagen_voucher' => 'required|mimes:jpg,png,jpeg,gif,webp',

                ], [
                    'required' => '* Campo obligatorio'
                ]
            );

            if($validar->fails())
            {
                return response()->json($validar->errors(),422);
            }
        }

        $registro_pago = RegistroPago::saveData($request);

        $success = JWT::encode($registro_pago,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function buscarClientes(Request $request)
    {
        $clientes = $this->cliente_model->getByFiltros($request->buscar);

        $success = JWT::encode(['clientes' =>$clientes],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function obtenerTodosPaginacion(Request $request)
    {
        $registro_pagos = RegistroPago::historialPagosWithPagination($request);

        $success = JWT::encode(['registro_pagos' =>$registro_pagos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function obtenerRegistroPagoDetallado(Request $request)
    {
        $registro_pago = RegistroPago::getAllDataById($request->id);

        $jwt = JWT::encode(['registro_pago' =>$registro_pago],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($jwt,200);
    }

    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function obtenerDatosRegistroPago(Request $request)
    {
        $registro_pago = RegistroPago::getDatabyId($request->id);

        $archivos = Storage::disk('registro-pagos')->allFiles($request->id);

        $jwt = JWT::encode([
            'registro_pago' =>$registro_pago,
            'vouchers' => $archivos
        ],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($jwt,200);
    }

    public function aceptarPago(Request $request)
    {
        $registro_pago = RegistroPago::aceptarPago($request);

        $success = JWT::encode($registro_pago,env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }


}
