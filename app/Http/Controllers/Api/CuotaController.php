<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cuota;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class CuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Cuota $cuota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuota $cuota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuota $cuota)
    {
        //
    }

    public function obtenerCuotasPorPrestamo(Request $request)
    {
        $cuotas = Cuota::getListByPrestamoId($request->prestamo_id);

        $success = JWT::encode(['cuotas' => $cuotas],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }
}
