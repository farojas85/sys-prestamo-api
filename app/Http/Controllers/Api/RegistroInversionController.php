<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inversion\StoreRegistroInversionRequest;
use App\Http\Requests\Inversion\UpdateRegistroInversionRequest;
use App\Models\RegistroInversion;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegistroInversionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $registroInversion = RegistroInversion::getAllPagination($request);

        $success = JWT::encode(['registro_inversiones' => $registroInversion],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegistroInversionRequest $request)
    {
        $request->validated();

        $registro_inversion = RegistroInversion::saveData($request);

        $success = JWT::encode(['registro_inversion' => $registro_inversion],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $registro_inversion =  RegistroInversion::getData($request);

        $success = JWT::encode(['registro_inversion' => $registro_inversion],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegistroInversionRequest $request)
    {
        $request->validated();

        $registro_inversion = RegistroInversion::updateData($request);

        $success = JWT::encode(['registro_inversion' => $registro_inversion],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $registro_inversion = RegistroInversion::deleteData($request);

        $success = JWT::encode(['registro_inversion' => $registro_inversion],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success);
    }
}
