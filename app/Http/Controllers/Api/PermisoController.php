<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permiso\StorePermisoRequest;
use App\Http\Requests\Permiso\UpdatePermisoRequest;
use App\Models\Permiso;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     *
     * @return encrypt array
     */
    public function index(Request $request)
    {
        $permisos = Permiso::getEnableds($request);

        $success = JWT::encode(['permisos'=> $permisos],env('VITE_SECRET_KEY'),'HS512');

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
        $permisos = Permiso::getDeletes($request);

        $success = JWT::encode(['permisos'=> $permisos],env('VITE_SECRET_KEY'),'HS512');

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
        $permisos = Permiso::getAll($request);

        $success = JWT::encode(['permisos'=> $permisos],env('VITE_SECRET_KEY'),'HS512');

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
        $permisos = Permiso::getActives($request);

        $success = JWT::encode(['permisos'=> $permisos],env('VITE_SECRET_KEY'),'HS512');

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
        $permisos = Permiso::getInactives($request);

        $success = JWT::encode(['permisos'=> $permisos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function obtenerPadres()
    {
        $padres = Permiso::getParents();

        $success = JWT::encode(['padres'=> $padres],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermisoRequest $request)
    {
        $request->validated();

        $permiso = Permiso::storeData($request);

        $success = JWT::encode($permiso,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $permiso = Permiso::find($id);

        $success = JWT::encode(['permiso'=>$permiso],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermisoRequest $request, int $id)
    {
        $request->validated();

        $permiso = Permiso::updateData($request,$id);

        $success = JWT::encode($permiso,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permiso $permiso)
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
        $permiso = Permiso::disableRecord($id);

        $success = JWT::encode($permiso,env('VITE_SECRET_KEY'),'HS512');
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
        $permiso = Permiso::enableRecord($id);

        $success = JWT::encode($permiso,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
