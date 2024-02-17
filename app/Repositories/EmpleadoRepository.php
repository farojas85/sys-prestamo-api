<?php

namespace App\Repositories;

use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Empleado;
use App\Models\Provincia;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoRepository  extends Repository
{
     /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model(): mixed
    {
        return Empleado::class;
    }

    public function listarEmpleados(Request $request)
    {
        if(in_array($request->role,['super-usuario','gerente']))
        {
            return $this->model->join('users as usu','usu.id','=','empleados.user_id')
                    ->join('role_user as ru','ru.user_id','=','usu.id')
                    ->join('roles as ro','ro.id','=','ru.role_id')
                    ->join('personas as per','per.id','=','empleados.persona_id')
                    ->select(
                        'empleados.id',
                        DB::Raw("concat(upper(per.apellido_paterno),' ',upper(per.apellido_materno),', ',upper(per.nombres)) as empleado")
                    )
                    ->whereIn('ro.slug',['lider','lider-superior'])
                    ->get();
        }
        if($request->role == 'lider-superior')
        {
            return $this->model->join('users as usu','usu.id','=','empleados.user_id')
                    ->join('role_user as ru','ru.user_id','=','usu.id')
                    ->join('roles as ro','ro.id','=','ru.role_id')
                    ->join('personas as per','per.id','=','empleados.persona_id')
                    ->join('empleados as super','super.id','=','empleados.superior_id')
                    ->select(
                        'empleados.id',
                        DB::Raw("concat(upper(per.apellido_paterno),' ',upper(per.apellido_materno),', ',upper(per.nombres)) as empleado")
                    )
                    ->whereIn('ro.slug',['lider'])
                    ->where('super.user_id',$request->user_id)
                    ->get();
        }
    }

    public function listarLideres(Request $request)
    {
        if(in_array($request->role,['super-usuario','gerente']))
        {
            return $this->model->join('users as usu','usu.id','=','empleados.user_id')
                    ->join('role_user as ru','ru.user_id','=','usu.id')
                    ->join('roles as ro','ro.id','=','ru.role_id')
                    ->join('personas as per','per.id','=','empleados.persona_id')
                    ->select(
                        'empleados.id',
                        DB::Raw("concat(upper(per.apellido_paterno),' ',upper(per.apellido_materno),', ',upper(per.nombres)) as empleado")
                    )
                    ->whereIn('ro.slug',['lider-superior'])
                    ->get();
        }
        if($request->role == 'lider-superior')
        {
            return $this->model->join('users as usu','usu.id','=','empleados.user_id')
                    ->join('role_user as ru','ru.user_id','=','usu.id')
                    ->join('roles as ro','ro.id','=','ru.role_id')
                    ->join('personas as per','per.id','=','empleados.persona_id')
                    ->join('empleados as super','super.id','=','empleados.superior_id')
                    ->select(
                        'empleados.id',
                        DB::Raw("concat(upper(per.apellido_paterno),' ',upper(per.apellido_materno),', ',upper(per.nombres)) as empleado")
                    )
                    ->whereIn('ro.slug',['lider'])
                    ->where('super.user_id',$request->user_id)
                    ->get();
        }
    }

}
