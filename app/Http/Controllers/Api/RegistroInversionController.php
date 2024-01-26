<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        $success = JWT::encode($registroInversion,env('VITE_SECRET_KEY'),'HS512');
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
    public function show(RegistroInversion $registroInversion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegistroInversion $registroInversion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegistroInversion $registroInversion)
    {
        //
    }
}
