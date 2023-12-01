<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Desembolso\StoreDesembolsoRequest;
use App\Models\Desembolso;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class DesembolsoController extends Controller
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
    public function store(StoreDesembolsoRequest $request)
    {
        $request->validated();

        $desembolso = Desembolso::saveData($request);

        $success = JWT::encode(['desembolso'=> $desembolso],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Desembolso $desembolso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Desembolso $desembolso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desembolso $desembolso)
    {
        //
    }
}
