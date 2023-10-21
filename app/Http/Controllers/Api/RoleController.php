<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class RoleController extends Controller
{
     /**
     * Display a listing of the resource.
     * @param Request $request
     *
     * @return encrypt array
     */
    public function index(Request $request)
    {
        $roles = Role::getEnableds($request);

        $success = JWT::encode(['roles'=> $roles],env('VITE_SECRET_KEY'),'HS512');

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
        $roles = Role::getDeletes($request);

        $success = JWT::encode(['roles'=> $roles],env('VITE_SECRET_KEY'),'HS512');

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
        $roles = Role::getAll($request);

        $success = JWT::encode(['roles'=> $roles],env('VITE_SECRET_KEY'),'HS512');

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
        $roles = Role::getActives($request);

        $success = JWT::encode(['roles'=> $roles],env('VITE_SECRET_KEY'),'HS512');

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
        $roles = Role::getInactives($request);

        $success = JWT::encode(['roles'=> $roles],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $request->validated();

        $role = Role::storeData($request);

        $success = JWT::encode($role,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $role = Role::find($id);

        $success = JWT::encode(['role'=>$role],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, int $id)
    {
        $request->validated();

        $role = Role::updateData($request,$id);

        $success = JWT::encode($role,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $Role)
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
        $role = Role::disableRecord($id);

        $success = JWT::encode($role,env('VITE_SECRET_KEY'),'HS512');
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
        $role = Role::enableRecord($id);

        $success = JWT::encode($role,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
