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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestamo $prestamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestamo $prestamo)
    {
        //
    }
}
