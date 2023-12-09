<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notificacion\StoreNotificacionRequest;
use App\Models\Notificacion;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $notificaciones = Notificacion::getAllPagination($request);

        $success = JWT::encode(['notificaciones'=> $notificaciones],config('app.jwt_secret_key'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificacionRequest $request)
    {
        $request->validated();

        $notificacion = Notificacion::saveData($request);

        $success = JWT::encode($notificacion,config('app.jwt_secret_key'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $notificacion = Notificacion::where('id',$request->id)->first();

        $success = JWT::encode(['notificacion' => $notificacion],config('app.jwt_secret_key'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreNotificacionRequest $request)
    {
        $request->validated();

        $notificacion = Notificacion::updateData($request);

        $success = JWT::encode($notificacion,config('app.jwt_secret_key'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $notificacion = Notificacion::deleteRecord($request);

        $success = JWT::encode($notificacion,config('app.jwt_secret_key'),'HS512');

        return response()->json($success,200);
    }

    /**
     * @return [type]
     */
    public function obtenerNotificacionActiva(Request $request)
    {
        $notificacion = Notificacion::getNotificacionActiva($request);

        $success = JWT::encode(['notificacion' => $notificacion],config('app.jwt_secret_key'),'HS512');

        return response()->json($success,200);

    }
}
