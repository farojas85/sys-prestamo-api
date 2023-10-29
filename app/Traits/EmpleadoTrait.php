<?php
namespace App\Traits;

use App\Models\Persona;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait EmpleadoTrait
{
    /**
     * get all data Empleado
     * @return object
     */
    public function getAllData(): object
    {

        $persona = $this->persona()->select(
            'tipo_documento_id','numero_documento','nombres','apellido_paterno','apellido_materno',
            'sexo_id','direccion','telefono'
        )->first();

        $tipo_documento =$persona->tipo_documento()->select('id','nombre_corto')->first();

        $sexo = $persona->sexo()->select('id','nombre')->first();

        $usuario =$this->user()->select(
            'id','name','email','foto','es_activo'
        )->first();

        return (object) array(
            'empleado' => $this,
            'persona' => $persona,
            'tipo_documento' => $tipo_documento,
            'sexo' => $sexo,
            'usuario' => $usuario
        );
    }
    /**
     * To get enableds pagination listing
     * @param Request $request
     *
     * @return [type]
     */
    public static function getEnableds(Request $request) {
        $buscar = mb_strtoupper($request->buscar);
        return Self::join('personas as pe','pe.id','=','empleados.persona_id')
                    ->leftJoin('users as usu','usu.id','=','empleados.user_id')
                    ->select(
                        'empleados.id','pe.numero_documento',
                        DB::Raw("upper(concat(pe.apellido_paterno,' ',pe.apellido_materno,', ',pe.nombres)) as apellidos_nombres"),
                        'pe.telefono'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(pe.numero_documento)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(pe.nombres)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(concat(pe.apellido_paterno,' ',pe.apellido_materno))"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(usu.name)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(usu.email)"),'like','%'.$buscar.'%');
                    })
                    ->orderBy('empleados.es_activo','desc')
                    ->orderBy('empleados.id','asc')
                    ->paginate($request->paginacion)
        ;
    }

    /**
     * Store data
     * @param Request $request
     *
     * @return [type]
     */
    public static function storeData(Request $request)
    {
        try {

            $persona = Persona::where('numero_documento',$request->numero_documento)->first();

            if(!$persona) {
                $persona = Persona::create([
                    'tipo_documento_id' => $request->tipo_documento_id,
                    'numero_documento' => $request->numero_documento,
                    'nombres' => $request->nombres,
                    'apellido_paterno' => $request->apellido_paterno,
                    'apellido_materno' => $request->apellido_materno,
                    'sexo_id' => $request->sexo_id,
                    'telefono' => $request->telefono,
                    'direccion' => $request->direccion
                ]);
            }

            $user = User::where('name',$request->name)->first();

            if(!$user)
            {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' =>Hash::make($request->password)
                ]);
            }

            $user->roles()->sync($request->role_id);

            $empleado = Self::where('persona_id',$persona->id)->first();

            if(!$empleado)
            {
                $empleado = Self::create([
                    'persona_id' => $persona->id,
                    'user_id' => $user->id
                ]);
            }

            return array(
                'ok' => 1,
                'mensaje' => 'Empleado '.$request->nombres." ha sido registrado satisfactoriamente",
                'data' => $empleado
            );
        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

    /**
     * Update data
     * @param Request $request
     * @param int $id
     *
     * @return [type]
     */
    public static function updateData(Request $request,int $id)
    {
        try {

            $empleado = self::find($request->id);

            $persona = Persona::find($empleado->persona_id);

            if(!$persona) {
                $persona =
                Persona::create([
                    'tipo_documento_id' => $request->tipo_documento_id,
                    'numero_documento' => $request->numero_documento,
                    'nombres' => $request->nombres,
                    'apellido_paterno' => $request->apellido_paterno,
                    'apellido_materno' => $request->apellido_materno,
                    'sexo_id' => $request->sexo_id,
                    'telefono' => $request->telefono,
                    'direccion' => $request->direccion
                ]);

            }
            if($persona) {

                $persona->tipo_documento_id = $request->tipo_documento_id;
                $persona->numero_documento = $request->numero_documento;
                $persona->nombres = $request->nombres;
                $persona->apellido_paterno = $request->apellido_paterno;
                $persona->apellido_materno = $request->apellido_materno;
                $persona->sexo_id = $request->sexo_id;
                $persona->telefono = $request->telefono;
                $persona->direccion = $request->direccion;
                $persona->save();
            }

            $user = User::find($empleado->user_id);

            if(!$user) {
                $user =
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' =>Hash::make($request->password)
                ]);
            }

            if($user)
            {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();
            }

            $contar_editar = 0;
            if($persona->id != $empleado->persona_id)
            {
                $empleado->persona_id = $persona->id;
                $contar_editar +=1;
            }

            if($user->id != $empleado->user_id)
            {
                $empleado->user_id = $user->id;
                $contar_editar+=1;
            }

            if($contar_editar >= 1)
            {
                $empleado->save();
            }

            return array(
                'ok' => 1,
                'mensaje' => 'El empleado '.$request->nombres." ha sido modificada satisfactoriamente",
                'data' => $empleado
            );
        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

}
