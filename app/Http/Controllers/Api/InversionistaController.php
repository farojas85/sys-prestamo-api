<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inversionista\StoreInversionistaRequest;
use App\Models\Inversionista;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InversionistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $inversionistas = Inversionista::getEnableds($request);

        $success = JWT::encode(['inversionistas'=> $inversionistas],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInversionistaRequest $request)
    {
        $request->validated();

        $inversionista = Inversionista::storeData($request);

        $success = JWT::encode($inversionista,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $inversionista = Inversionista::find($request->id)->getAllData();

        $success = JWT::encode(['inversionista'=>$inversionista],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request):JsonResponse
    {
        $inversionista = Inversionista::updateData($request,$request->id);

        $success = JWT::encode($inversionista,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inversionista $inversionista)
    {
        //
    }

     /**
     * Disable the specified resource in storage
     * @param int $id
     *
     * @return JsonResponse
     */
    public function inhabilitar(int $id) :JsonResponse
    {
        $inversionista = Inversionista::disableRecord($id);

        $success = JWT::encode($inversionista,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * enable the specified resource in storage
     * @param int $id
     *
     * @return JsonResponse
     */
    public function habilitar(int $id) :JsonResponse
    {
        $inversionista = Inversionista::enableRecord($id);

        $success = JWT::encode($inversionista,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
