<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prestamo;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $prestamos = Prestamo::getEnableds($request);

        $success = JWT::encode(['prestamos'=> $prestamos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function todos(Request $request)
    {
        $prestamos = Prestamo::getAll($request);

        $success = JWT::encode(['prestamos'=> $prestamos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function eliminados(Request $request)
    {
        $prestamos = Prestamo::getDeletes($request);

        $success = JWT::encode(['prestamos'=> $prestamos],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prestamo = Prestamo::storeData($request);

        $success = JWT::encode($prestamo,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Modificar el estado de un préstamo
     * @param Request $request
     *
     * @return [type]
     */
    public function modificarEstado(Request $request)
    {
        $prestamo = Prestamo::cambiarEstadoPrestamo($request);

        $success = JWT::encode($prestamo,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $prestamo = Prestamo::getData($id);

        $success = JWT::encode($prestamo,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //$request->validated();

        $prestamo = Prestamo::updateData($request,$id);

        $success = JWT::encode($prestamo,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $prestamo = Prestamo::deleteRecord($request);

        $success = JWT::encode($prestamo,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
