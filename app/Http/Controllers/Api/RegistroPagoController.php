<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Models\RegistroPago;

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
        //
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

    public function buscarClientes(Request $request)
    {
        $clientes = $this->cliente_model->getByFiltros($request->buscar);

        $success = JWT::encode(['clientes' =>$clientes],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
}
