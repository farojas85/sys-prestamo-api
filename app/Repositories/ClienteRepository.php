<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteRepository  extends Repository
{
     /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model(): mixed
    {
        return Cliente::class;
    }

    /**
     * get all data Empleado
     * @return object
     */
    public function getAllData(): object
    {

        $cliente = $this;

        $persona = $this->model->persona()->select(
            'id','tipo_documento_id','numero_documento','nombres','apellido_paterno','apellido_materno',
            'sexo_id','direccion','telefono'
        )->first();

        $tipo_documento =$persona->tipo_documento()->select('id','nombre_corto')->first();

        $sexo = $persona->sexo()->select('id','nombre')->first();

        $distrito = $this->model->distrito()->first();

        $cliente_cuentas = $this->model->cliente_cuentas()->get();


        // $cliente_cuentas  = ClienteCuenta::join('entidad_financieras as ef','ef.id','=','cliente_cuentas.entidad_financiera_id')
        //                         ->select(
        //                             'cliente_cuentas.id','cliente_cuentas.cliente_id','cliente_cuentas.entidad_financiera_id',
        //                             'ef.nombre as banco','cliente_cuentas.numero_cuenta','cliente_cuentas.es_activo'
        //                         )
        //                         ->where('cliente_id',$cliente->id)
        //                         ->get();

        $provincia = null;
        $departamento = null;
        $provincias = [];
        $distritos = [];

        if($distrito)
        {
            $provincia = $distrito->provincia()->select('id','codigo','nombre','departamento_id')->first();

            $departamento = $provincia->departamento()->select('id','codigo','nombre')->first() ;

            $provincias = Provincia::select('id','codigo','nombre')->where('departamento_id',$departamento->id)->get();

            $distritos = Distrito::select('id','codigo','nombre')->where('provincia_id',$provincia->id)->get();
        }

        $departamentos = Departamento::select('id','codigo','nombre')->get();

        return (object) array(
            'cliente' => $this->model->select('clientes.id','persona_id','distrito_id','es_activo')->first(),
            'persona' => $persona,
            'tipo_documento' => $tipo_documento,
            'sexo' => $sexo,
            'distrito' =>  $distrito,
            'provincia' => $provincia,
            'departamento' => $departamento,
            'distritos' => $distritos,
            'provincias' => $provincias,
            'departamentos' => $departamentos,
            'cliente_cuentas' => $cliente_cuentas
        );
    }

    /**
     * To get enableds pagination listing
     * @param Request $request
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getEnableds(Request $request): Collection
    {
        $buscar = mb_strtoupper($request->buscar);
        $empleadoId = DB::table('empleados')->select('id')->where('user_id',$request->user)->value('id');

        $clientesQuery = $this->model
            ->join('personas as pe', 'pe.id', '=', 'clientes.persona_id')
            ->leftJoin('empleados as emp', 'emp.id', '=', 'clientes.empleado_id')
            ->leftJoin('personas as perp', 'perp.id', '=', 'emp.persona_id')
            ->select(
                'clientes.id',
                'pe.numero_documento',
                DB::raw("UPPER(CONCAT(pe.apellido_paterno, ' ', pe.apellido_materno, ', ', pe.nombres)) AS apellidos_nombres"),
                DB::raw("UPPER(CONCAT(perp.apellido_paterno, ' ', perp.apellido_materno, ', ', perp.nombres)) AS lider"),
                'pe.telefono',
                'clientes.es_activo'
            )
            ->where(function($query) use ($buscar) {
                $query->where(DB::raw("UPPER(pe.numero_documento)"), 'LIKE', '%' . $buscar . '%')
                    ->orWhere(DB::raw("UPPER(pe.nombres)"), 'LIKE', '%' . $buscar . '%')
                    ->orWhere(DB::raw("UPPER(CONCAT(pe.apellido_paterno, ' ', pe.apellido_materno))"), 'LIKE', '%' . $buscar . '%');
            })
        ;

        if($request->role == 'super-usuario')
        {
            $lideresQuery = DB::table('empleados')->where('superior_id','like',$request->lider)->pluck('id');
            $clientesQuery->whereIn('empleado_id',$lideresQuery);
        }
        else if (in_array($request->role, ['gerente', 'lider-superior'])) {
            $lideresQuery = DB::table('empleados')->where('superior_id',$empleadoId)->where('id','like',$request->lider)->pluck('id');
            $clientesQuery->whereIn('empleado_id', $lideresQuery);
        } else {
            $clientesQuery->where('empleado_id', $empleadoId);
        }

        $clientes = $clientesQuery->orderBy('clientes.es_activo', 'desc')
            ->orderBy('clientes.id', 'asc')
            ->paginate($request->paginacion);

        return Collection::make($clientes);
    }

}
