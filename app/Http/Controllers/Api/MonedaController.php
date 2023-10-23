<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Moneda\StoreMonedaRequest;
use App\Http\Requests\Moneda\UpdateMonedaRequest;
use App\Models\Moneda;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class MonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     *
     * @return encrypt array
     */
    public function index(Request $request)
    {
        $monedas = Moneda::getAll($request);

        $success = JWT::encode(['monedas'=> $monedas],env('VITE_SECRET_KEY'),'HS512');

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
        $monedas = Moneda::getActives($request);

        $success = JWT::encode(['monedas'=> $monedas],env('VITE_SECRET_KEY'),'HS512');

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
        $monedas = Moneda::getInactives($request);

        $success = JWT::encode(['monedas'=> $monedas],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function obtenerLista()
    {
        $monedas = Moneda::getList();

        $success = JWT::encode(['monedas'=> $monedas],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMonedaRequest $request)
    {
        $request->validated();

        $moneda = Moneda::storeData($request);

        $success = JWT::encode($moneda,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $moneda = Moneda::find($id);

        $success = JWT::encode(['moneda'=>$moneda],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMonedaRequest $request, int $id)
    {
        $request->validated();

        $moneda = Moneda::updateData($request,$id);

        $success = JWT::encode($moneda,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moneda $Moneda)
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
        $moneda = Moneda::disableRecord($id);

        $success = JWT::encode($moneda,env('VITE_SECRET_KEY'),'HS512');
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
        $moneda = Moneda::enableRecord($id);

        $success = JWT::encode($moneda,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
