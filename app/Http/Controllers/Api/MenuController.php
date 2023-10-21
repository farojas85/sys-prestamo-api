<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Models\Menu;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     *
     * @return encrypt array
     */
    public function index(Request $request)
    {
        $menus = Menu::getEnableds($request);

        $success = JWT::encode(['menus'=> $menus],env('VITE_SECRET_KEY'),'HS512');

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
        $menus = Menu::getDeletes($request);

        $success = JWT::encode(['menus'=> $menus],env('VITE_SECRET_KEY'),'HS512');

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
        $menus = Menu::getAll($request);

        $success = JWT::encode(['menus'=> $menus],env('VITE_SECRET_KEY'),'HS512');

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
        $menus = Menu::getActives($request);

        $success = JWT::encode(['menus'=> $menus],env('VITE_SECRET_KEY'),'HS512');

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
        $menus = Menu::getInactives($request);

        $success = JWT::encode(['menus'=> $menus],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function obtenerPadres()
    {
        $padres = Menu::getParents();

        $success = JWT::encode(['padres'=> $padres],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $request->validated();

        $menu = Menu::storeData($request);

        $success = JWT::encode($menu,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $menu = Menu::find($id);

        $success = JWT::encode(['menu'=>$menu],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, int $id)
    {
        $request->validated();

        $menu = Menu::updateData($request,$id);

        $success = JWT::encode($menu,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
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
        $menu = Menu::disableRecord($id);

        $success = JWT::encode($menu,env('VITE_SECRET_KEY'),'HS512');
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
        $menu = Menu::enableRecord($id);

        $success = JWT::encode($menu,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
