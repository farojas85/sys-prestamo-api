<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\StoreClienteRequest;
use App\Models\Cliente;
use App\Models\ClienteCuenta;
use App\Models\Persona;
use App\Repositories\ClienteRepository;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    protected $clienteRepository;

    public function __construct(ClienteRepository $repository)
    {
        $this->clienteRepository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clientes = $this->clienteRepository->getEnableds($request);

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


    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function subirDniAnverso(Request $request)
    {
        $cliente = Cliente::uploadDniAnverso($request);

        $success = JWT::encode($cliente,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function subirDniReverso(Request $request)
    {
        $cliente = Cliente::uploadDniReverso($request);

        $success = JWT::encode($cliente,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    public function mostrarDocumentos(Request $request)
    {
        $cliente = Cliente::find($request->id);

        $persona_dni = Persona::find($cliente->persona_id)->dni;

        $archivos = Storage::disk('clientes')->allFiles($persona_dni);

        $documentos = JWT::encode($archivos,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($documentos,200);
    }

    public function listarCuentas(Request $request)
    {
        $cliente_cuentas = ClienteCuenta::getListByClienteId($request->cliente_id);

        $jwt = JWT::encode(['cliente_cuentas' =>$cliente_cuentas],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($jwt,200);
    }
}
