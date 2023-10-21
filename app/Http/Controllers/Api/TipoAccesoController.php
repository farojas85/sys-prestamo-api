<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoAcceso\StoreTipoAccesoRequest;
use App\Http\Requests\TipoAcceso\UpdateTipoAccesoRequest;
use App\Models\TipoAcceso;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class TipoAccesoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     *
     * @return encrypt array
     */
    public function index(Request $request)
    {
        $tipo_accesos = TipoAcceso::getEnableds($request);

        $success = JWT::encode([ 'tipo_accesos'=> $tipo_accesos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Displat a pagination listing og the resource
     * @param Request $request
     *
     * @return encrypt array
     */
    public function obtenerEliminados(Request $request)
    {
        $tipo_accesos = TipoAcceso::getDeletes($request);

        $success = JWT::encode(['tipo_accesos'=> $tipo_accesos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Display a pagination listing of the resource
     * @param Request $request
     *
     * @return encrypt array
     */
    public function obtenerTodos(Request $request)
    {
        $tipo_accesos = TipoAcceso::getAll($request);

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
        $tipo_accesos = TipoAcceso::getActives($request);

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
        $tipo_accesos = TipoAcceso::getInactives($request);

        $success = JWT::encode(['tipo_accesos'=> $tipo_accesos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTipoAccesoRequest $request)
    {
        $request->validated();

        $tipo_acceso = TipoAcceso::storeData($request);

        $success = JWT::encode($tipo_acceso,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $tipo_acceso = TipoAcceso::find($id);

        $success = JWT::encode(['tipo_acceso'=>$tipo_acceso],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTipoAccesoRequest $request, int $id)
    {
        $request->validated();

        $tipo_acceso = TipoAcceso::updateData($request,$id);

        $success = JWT::encode($tipo_acceso,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoAcceso $tipoAcceso)
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
        $tipo_acceso = TipoAcceso::disableRecord($id);

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
        $tipo_acceso = TipoAcceso::enableRecord($id);

        $success = JWT::encode($tipo_acceso,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
