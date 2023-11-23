<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\StoreClienteRequest;
use App\Models\Cliente;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clientes = Cliente::getEnableds($request);

        $success = JWT::encode(['clientes'=> $clientes],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        $request->validated();

        $cliente = Cliente::storeData($request);

        $success = JWT::encode($cliente,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $cliente = Cliente::find($request->id)->getAllData();

        $success = JWT::encode(['cliente'=>$cliente],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //$request->validated();

        $cliente = Cliente::updateData($request,$id);

        $success = JWT::encode($cliente,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }

    public function buscarPorNumeroDocumento(Request $request)
    {
        $cliente = Cliente::getByNumeroDocumento($request->numero_documento);

        $success = JWT::encode(['cliente' => $cliente] ,env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,201);
    }

    public function obtenerPrestamosCliente(Request $request)
    {

    }
}
