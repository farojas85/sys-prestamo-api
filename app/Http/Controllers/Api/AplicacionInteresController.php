<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AplicacionInteres\StoreAplicacionInteresRequest;
use App\Http\Requests\AplicacionInteres\UpdateAplicacionInteresRequest;
use App\Models\AplicacionInteres;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class AplicacionInteresController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     *
     * @return encrypt array
     */
    public function index(Request $request)
    {
        $aplicacion_intereses = AplicacionInteres::getAll($request);

        $success = JWT::encode(['aplicacion_intereses'=> $aplicacion_intereses],env('VITE_SECRET_KEY'),'HS512');

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
        $aplicacion_intereses = AplicacionInteres::getActives($request);

        $success = JWT::encode(['aplicacion_intereses'=> $aplicacion_intereses],env('VITE_SECRET_KEY'),'HS512');

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
        $aplicacion_intereses = AplicacionInteres::getInactives($request);

        $success = JWT::encode(['aplicacion_intereses'=> $aplicacion_intereses],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function obtenerLista()
    {
        $aplicacion_intereses = AplicacionInteres::getList();

        $success = JWT::encode(['aplicacion_intereses'=> $aplicacion_intereses],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAplicacionInteresRequest $request)
    {
        $request->validated();

        $aplicacion_interes = AplicacionInteres::storeData($request);

        $success = JWT::encode($aplicacion_interes,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $aplicacion_interes = AplicacionInteres::find($id);

        $success = JWT::encode(['aplicacion_interes'=>$aplicacion_interes],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAplicacionInteresRequest $request, int $id)
    {
        $request->validated();

        $aplicacion_interes = AplicacionInteres::updateData($request,$id);

        $success = JWT::encode($aplicacion_interes,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AplicacionInteres $AplicacionInteres)
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
        $aplicacion_interes = AplicacionInteres::disableRecord($id);

        $success = JWT::encode($aplicacion_interes,env('VITE_SECRET_KEY'),'HS512');
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
        $aplicacion_interes = AplicacionInteres::enableRecord($id);

        $success = JWT::encode($aplicacion_interes,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
