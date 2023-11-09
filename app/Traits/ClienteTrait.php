<?php
namespace App\Traits;

use App\Models\Persona;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait ClienteTrait
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

        return (object) array(
            'cliente' => $this,
            'persona' => $persona,
            'tipo_documento' => $tipo_documento,
            'sexo' => $sexo
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
        return Self::join('personas as pe','pe.id','=','clientes.persona_id')
                    ->select(
                        'clientes.id','pe.numero_documento',
                        DB::Raw("upper(concat(pe.apellido_paterno,' ',pe.apellido_materno,', ',pe.nombres)) as apellidos_nombres"),
                        'pe.telefono','clientes.es_activo'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(pe.numero_documento)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(pe.nombres)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(concat(pe.apellido_paterno,' ',pe.apellido_materno))"),'like','%'.$buscar.'%');
                    })
                    ->orderBy('clientes.es_activo','desc')
                    ->orderBy('clientes.id','asc')
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
                    'direccion' => $request->direccion,
                    'correo_personal' => $request->correo_personal
                ]);
            }

            $cliente = Self::where('persona_id',$persona->id)->first();

            if(!$cliente)
            {
                $cliente = Self::create([
                    'persona_id' => $persona->id
                ]);
            }

            return array(
                'ok' => 1,
                'mensaje' => 'El cliente '.$request->nombres." ha sido registrado satisfactoriamente",
                'data' => $cliente
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

            $cliente = self::find($request->id);

            $persona = Persona::find($cliente->persona_id);

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

            if($persona->id != $cliente->persona_id)
            {
                $cliente->persona_id = $persona->id;
                $cliente->save();
            }

            return array(
                'ok' => 1,
                'mensaje' => 'El cliente '.$request->nombres." ha sido modificada satisfactoriamente",
                'data' => $cliente
            );
        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

    public static function getByNumeroDocumento(string $numero_documento)
    {
        return self::join('personas as per','per.id','=','clientes.persona_id')
                ->select(
                    'clientes.id','per.tipo_documento_id','per.numero_documento','per.nombres',
                    'per.apellido_paterno', 'per.apellido_materno', 'per.telefono','per.direccion',
                    'per.correo_personal'
                )
                ->where('per.numero_documento',$numero_documento)
                ->first();

    }
}
