<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Empleado\StoreEmpleadoRequest;
use App\Http\Requests\Empleado\UpdateEmpleadoRequest;
use App\Models\Empleado;
use App\Models\Persona;
use App\Models\TipoDocumento;
use App\Repositories\EmpleadoRepository;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    protected $empleadoRepository;

    public function __construct(EmpleadoRepository $repository)
    {
        $this->empleadoRepository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $empleados = Empleado::getEnableds($request);

        $success = JWT::encode(['empleados'=> $empleados],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpleadoRequest $request)
    {
        $request->validated();

        $empleado = Empleado::storeData($request);

        $success = JWT::encode($empleado,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $empleado = Empleado::find($request->id)->getAllData();

        $success = JWT::encode(['empleado'=>$empleado],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //$request->validated();

        $empleado = Empleado::updateData($request,$request->id);

        $success = JWT::encode($empleado,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
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
        $empleado = Empleado::disableRecord($id);

        $success = JWT::encode($empleado,env('VITE_SECRET_KEY'),'HS512');
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
        $empleado = Empleado::enableRecord($id);

        $success = JWT::encode($empleado,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    public function listarSuperioresPorRole(Request $request)
    {
        $superiores = Empleado::getSuperioresByRole($request->role);

        $success = JWT::encode(['superiores' => $superiores],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    public function subirContrato(Request $request)
    {
        $empleado = Empleado::uploadContrato($request);

        $success = JWT::encode($empleado,env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    public function listarEmpleados(Request $request)
    {
        $empleados = Empleado::listarEmpleados($request);

        $success = JWT::encode(['empleados' => $empleados],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

    public function listarLideres(Request $request)
    {
        $lideres = $this->empleadoRepository->listarLideres($request);

        $success = JWT::encode(['lideres' => $lideres],env('VITE_SECRET_KEY'),'HS512');

        return response()->json($success,200);
    }

}
