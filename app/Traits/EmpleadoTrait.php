<?php
namespace App\Traits;

use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Persona;
use App\Models\Provincia;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

trait EmpleadoTrait
{
    /**
     * get all data Empleado
     * @return object
     */
    public function getAllData(): object
    {

        $empleado = $this;

        $persona = $this->persona()->select(
            'id','tipo_documento_id','numero_documento','nombres','apellido_paterno','apellido_materno',
            'sexo_id','direccion','telefono'
        )->first();

        $tipo_documento =$persona->tipo_documento()->select('id','nombre_corto')->first();

        $sexo = $persona->sexo()->select('id','nombre')->first();

        $usuario =$this->user()->select(
            'id','name','email','foto','es_activo'
        )->first();

        $roles = $usuario->roles()->select('roles.id','nombre','slug','tipo_acceso_id','roles.es_activo')->get()[0];

        $distrito = $this->distrito()->first();

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
            'empleado' => $this->select('empleados.id','persona_id','user_id','superior_id','distrito_id','es_activo')->first(),
            'persona' => $persona,
            'tipo_documento' => $tipo_documento,
            'sexo' => $sexo,
            'usuario' => $usuario,
            'role' => $roles,
            'distrito' =>  $distrito,
            'provincia' => $provincia,
            'departamento' => $departamento,
            'distritos' => $distritos,
            'provincias' => $provincias,
            'departamentos' => $departamentos
        );
    }

    public static function getData() {
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
                        'empleados.id','pe.numero_documento','usu.name',
                        DB::Raw("upper(concat(pe.apellido_paterno,' ',pe.apellido_materno,', ',pe.nombres)) as apellidos_nombres"),
                        'pe.telefono','empleados.es_activo','empleados.superior_id','empleados.contrato_pdf'
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

    public function getSuperior() {
        return $this->superior()->persona()->select('nombres','apellido_paterno','apellido_materno')->first();
    }

    public function getSubOrdinados() {
        return $this->subordinados();
    }

    public static function getSuperioresByRole(int $role)
    {
        $role = Role::select('slug')->where('id',$role)->first();

        if($role->slug == 'gerente')
        {
            return null;
        }
        if($role->slug  == 'lider-superior')
        {
            return DB::table('role_user as ru')->join('roles as r','r.id','=','ru.role_id')
                        ->join('empleados as emp','emp.user_id','=','ru.user_id')
                        ->join('personas as pe','pe.id','=','emp.persona_id')
                        ->select(
                            'emp.id',
                            DB::Raw("upper(concat(pe.nombres,' ',pe.apellido_paterno,' ',pe.apellido_materno)) as nombres_apellidos")
                        )
                        ->where('r.slug','gerente')
                        ->get();
        }

        if($role->slug  == 'lider')
        {
            return DB::table('role_user as ru')->join('roles as r','r.id','=','ru.role_id')
            ->join('empleados as emp','emp.user_id','=','ru.user_id')
            ->join('personas as pe','pe.id','=','emp.persona_id')
            ->select(
                'emp.id',
                DB::Raw("upper(concat(pe.nombres,' ',pe.apellido_paterno,' ',pe.apellido_materno)) as nombres_apellidos")
            )
            ->where('r.slug','lider-superior')
            ->get();
        }

        return null;
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

            $user_name = self::generarUsuario($request);
            if(!$user)
            {
                $user = User::create([
                    'name' => $user_name,
                    'email' => $request->email,
                    'password' =>Hash::make($request->numero_documento)
                ]);
            }

            $user->roles()->sync($request->role_id);

            $empleado = Self::where('persona_id',$persona->id)->first();

            if(!$empleado)
            {
                $empleado = Self::create([
                    'persona_id' => $persona->id,
                    'user_id' => $user->id,
                    'distrito_id' => $request->distrito_id
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

            $empleado = Self::find($id);

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

            $user_name = self::generarUsuario($request);

            if(!$user) {
                $user =
                User::create([
                    'name' => $request->user_name,
                    'email' => $request->email,
                    //'password' =>Hash::make($request->numero_documento)
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
            }

            if($empleado->distrito_id != $request->distrito_id)
            {
                $empleado->distrito_id = $request->distrito_id;
                $contar_editar+=1;
            }

            if($empleado->superior_id != $request->superior_id)
            {
                $empleado->superior_id = $request->superior_id;
                $contar_editar +=1;
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

    /**
     * To disable record
     * @param int $id
     *
     * @return [type]
     */
    public static function disableRecord(int $id) {
        try {
            $empleado = Self::where('id',$id)->first();
            $empleado->es_activo = 0;
            $empleado->save();

            if($empleado->user_id)
            {
                $user = User::where('id',$empleado->user_id)->update(['es_activo',0]);

            }

            return array(
                'ok' => 1,
                'mensaje' => 'El empleado ha sido inhabilitada satisfactoriamente',
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
     * To enable record
     * @param int $id
     *
     * @return [type]
     */
    public static function enableRecord(int $id) {
        try {
            $empleado = Self::where('id',$id)->first();
            $empleado->es_activo = 1;
            $empleado->save();

            if($empleado->user_id)
            {
                $user = User::where('id',$empleado->user_id)->update(['es_activo',1]);

            }
            return array(
                'ok' => 1,
                'mensaje' => 'El empleado ha sido habilitada satisfactoriamente',
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

    public static function generarUsuario(Request $request)
    {
        $nombres = explode(" ",mb_strtolower($request->nombres));

        $name = "";
        foreach($nombres as $nombre)
        {
            $name .= $nombre[0];
        }

        $ap_paterno = str_replace( " ", "" ,mb_strtolower($request->apellido_paterno));

        $ap_materno = str_replace( " ", "" ,mb_strtolower($request->apellido_materno));

        $usuario = $name.$ap_paterno.$ap_materno[0];

        $x=1;
        do {
            $usuario = $name.$ap_paterno.substr($ap_materno,0,1);
            $x+=1;
        } while(User::getByName($usuario));

        return $usuario;

    }

    /**
     * subir contrato pdf
     * @param Request $request
     *
     * @return [type]
     */
    public static function  uploadContrato(Request $request)
    {
        try {
            $empleado  = Self::find($request->empleado_id);

            $persona_dni = Persona::where('id',$empleado->persona_id)->first()->numero_documento;

            $file = $request->file('contrato');
            $nombre_archivo = "CONTRATO_".date('Y').".".$file->extension();

            Storage::disk('empleados')->put($persona_dni."/".$nombre_archivo,File::get($file));

            $empleado->contrato_pdf = $nombre_archivo;
            $empleado->save();

            return [
                'ok' => 1,
                'mensaje' => 'Contrato del Empleado fue subido satisfactoriamente',
                'data' => $nombre_archivo
            ];

        } catch (Exception $ex) {
            return [
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            ];
        }
    }

}
