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
        $tipo_accesos = FrecuenciaPago::getAll($request);

        $success = JWT::encode(['tipo_accesos'=> $tipo_accesos],env('VITE_SECRET_KEY'),'HS512');

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
        $tipo_accesos = FrecuenciaPago::getActives($request);

        $success = JWT::encode(['tipo_accesos'=> $tipo_accesos],env('VITE_SECRET_KEY'),'HS512');

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
        $tipo_accesos = FrecuenciaPago::getInactives($request);

        $success = JWT::encode(['tipo_accesos'=> $tipo_accesos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function obtenerLista()
    {
        $tipo_accesos = FrecuenciaPago::getList();

        $success = JWT::encode(['tipo_accesos'=> $tipo_accesos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFrecuenciaPagoRequest $request)
    {
        $request->validated();

        $tipo_acceso = FrecuenciaPago::storeData($request);

        $success = JWT::encode($tipo_acceso,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $tipo_acceso = FrecuenciaPago::find($id);

        $success = JWT::encode(['tipo_acceso'=>$tipo_acceso],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFrecuenciaPagoRequest $request, int $id)
    {
        $request->validated();

        $tipo_acceso = FrecuenciaPago::updateData($request,$id);

        $success = JWT::encode($tipo_acceso,env('VITE_SECRET_KEY'),'HS512');
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
        $tipo_acceso = FrecuenciaPago::disableRecord($id);

        $success = JWT::encode($tipo_acceso,env('VITE_SECRET_KEY'),'HS512');
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
        $tipo_acceso = FrecuenciaPago::enableRecord($id);

        $success = JWT::encode($tipo_acceso,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
