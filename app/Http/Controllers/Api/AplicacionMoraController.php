<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AplicacionMora\StoreAplicacionMoraRequest;
use App\Http\Requests\AplicacionMora\UpdateAplicacionMoraRequest;
use App\Models\AplicacionMora;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class AplicacionMoraController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     *
     * @return encrypt array
     */
    public function index(Request $request)
    {
        $aplicacion_moras = AplicacionMora::getAll($request);

        $success = JWT::encode(['aplicacion_moras'=> $aplicacion_moras],env('VITE_SECRET_KEY'),'HS512');

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
        $aplicacion_moras = AplicacionMora::getActives($request);

        $success = JWT::encode(['aplicacion_moras'=> $aplicacion_moras],env('VITE_SECRET_KEY'),'HS512');

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
        $aplicacion_moras = AplicacionMora::getInactives($request);

        $success = JWT::encode(['aplicacion_moras'=> $aplicacion_moras],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function obtenerLista()
    {
        $aplicacion_moras = AplicacionMora::getList();

        $success = JWT::encode(['aplicacion_moras'=> $aplicacion_moras],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAplicacionMoraRequest $request)
    {
        $request->validated();

        $aplicacion_mora = AplicacionMora::storeData($request);

        $success = JWT::encode($aplicacion_mora,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $aplicacion_mora = AplicacionMora::find($id);

        $success = JWT::encode(['aplicacion_mora'=>$aplicacion_mora],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAplicacionMoraRequest $request, int $id)
    {
        $request->validated();

        $aplicacion_mora = AplicacionMora::updateData($request,$id);

        $success = JWT::encode($aplicacion_mora,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AplicacionMora $AplicacionMora)
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
        $aplicacion_mora = AplicacionMora::disableRecord($id);

        $success = JWT::encode($aplicacion_mora,env('VITE_SECRET_KEY'),'HS512');
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
        $aplicacion_mora = AplicacionMora::enableRecord($id);

        $success = JWT::encode($aplicacion_mora,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
