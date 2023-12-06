<?php
namespace App\Traits;

use App\Models\ClienteCuenta;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Persona;
use App\Models\Prestamo;
use App\Models\Provincia;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

trait ClienteTrait
{
    /**
     * get all data Empleado
     * @return object
     */
    public function getAllData(): object
    {

        $cliente = $this;

        $persona = $this->persona()->select(
            'id','tipo_documento_id','numero_documento','nombres','apellido_paterno','apellido_materno',
            'sexo_id','direccion','telefono'
        )->first();

        $tipo_documento =$persona->tipo_documento()->select('id','nombre_corto')->first();

        $sexo = $persona->sexo()->select('id','nombre')->first();

        $distrito = $this->distrito()->first();

        $cliente_cuentas  = ClienteCuenta::join('entidad_financieras as ef','ef.id','=','cliente_cuentas.entidad_financiera_id')
                                ->select(
                                    'cliente_cuentas.id','cliente_cuentas.cliente_id','cliente_cuentas.entidad_financiera_id',
                                    'ef.nombre as banco','cliente_cuentas.numero_cuenta','cliente_cuentas.es_activo'
                                )
                                ->where('cliente_id',$cliente->id)
                                ->get();

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
            'cliente' => $this->select('clientes.id','persona_id','distrito_id','es_activo')->first(),
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
                    'persona_id' => $persona->id,
                    'distrito_id' => $request->distrito_id,
                    'empleado_id' => $request->empleado_id,
                ]);
            }

            if($request->cuentas_bancarias)
            {
                foreach($request->cuentas_bancarias as $cuenta)
                {
                    $cliente_cuenta = ClienteCuenta::where('cliente_id',$cuenta['cliente_id'])
                                        ->where('entidad_financiera_id',$cuenta['entidad_financiera_id'])
                                        ->first()
                    ;

                    if(!$cliente_cuenta)
                    {
                        $cliente_cuenta = new ClienteCuenta();
                        $cliente_cuenta->cliente_id = $cliente->id;
                        $cliente_cuenta->entidad_financiera_id = $cuenta['entidad_financiera_id'];
                        $cliente_cuenta->numero_cuenta = $cuenta['numero_cuenta'];
                        $cliente_cuenta->es_activo =1;
                        $cliente_cuenta->save();
                    }

                    if($cliente_cuenta)
                    {
                        $cliente_cuenta->numero_cuenta = $cuenta['numero_cuenta'];
                        $cliente_cuenta->es_activo =1;
                        $cliente_cuenta->save();
                    }
                }
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
                    'direccion' => $request->direccion,
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
                $cliente->distrito_id = $request->distrito_id;
                $cliente->save();
            }

            if($request->cuentas_bancarias)
            {
                foreach($request->cuentas_bancarias as $cuenta)
                {
                    $cliente_cuenta = ClienteCuenta::where('cliente_id',$cuenta['cliente_id'])
                                        ->where('entidad_financiera_id',$cuenta['entidad_financiera_id'])
                                        ->first()
                    ;

                    if(!$cliente_cuenta)
                    {
                        $cliente_cuenta = new ClienteCuenta();
                        $cliente_cuenta->cliente_id = $cliente->id;
                        $cliente_cuenta->entidad_financiera_id = $cuenta['entidad_financiera_id'];
                        $cliente_cuenta->numero_cuenta = $cuenta['numero_cuenta'];
                        $cliente_cuenta->es_activo =1;
                        $cliente_cuenta->save();
                    }

                    if($cliente_cuenta)
                    {
                        $cliente_cuenta->numero_cuenta = $cuenta['numero_cuenta'];
                        $cliente_cuenta->es_activo =1;
                        $cliente_cuenta->save();
                    }
                }
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

    public function getByFiltros(string $busqueda)
    {
        $busqueda = mb_strtoupper($busqueda);

        return $this->join('personas as per','per.id','=','clientes.persona_id')
                ->select(
                    'clientes.id','per.tipo_documento_id','per.numero_documento',
                    DB::Raw("upper(CONCAT(per.apellido_paterno,' ',per.apellido_materno,' ',per.nombres)) as cliente"),
                    'per.nombres','per.apellido_paterno', 'per.apellido_materno', 'per.telefono','per.direccion',
                    'per.correo_personal'
                )
                ->where(function($query) use($busqueda){
                    $query->where('per.numero_documento','like',$busqueda.'%')
                        ->orWhere( DB::Raw("upper(CONCAT(per.apellido_paterno,' ',per.apellido_materno))"),'like', '%'.$busqueda.'%')
                        ->orWhere( DB::Raw("upper(per.nombres)"),'like', '%'.$busqueda.'%');
                })
                ->get();

    }

    public function getDataPrestamos(Request $request)
    {
        $cliente = $this->with(['persona:id,numero_documento,nombres,apellido_paterno,apellido_materno'])
                    ->where('clientes.id',$request->cliente)
                    ->first()
        ;

        $prestamos = Prestamo::select('id','fecha_prestamo','capital_inicial','interes')
                    ->where('cliente_id',$cliente->id)
                    ->orderBy('fercha_prestamo','asc')
                    ->get()
        ;

        return [
            'cliente' => $cliente,
            'prestamos' => $prestamos
        ];

    }

    /**
     * subir contrato pdf
     * @param Request $request
     *
     * @return [type]
     */
    public static function  uploadDniAnverso(Request $request)
    {
        try {
            $cliente  = Self::find($request->cliente_id);

            $persona_dni = Persona::where('id',$cliente->persona_id)->first()->numero_documento;

            $file = $request->file('dni_anverso');
            $nombre_archivo = "DNI_ANVERSO_".date('Y').".".$file->extension();

            Storage::disk('clientes')->put($persona_dni."/".$nombre_archivo,File::get($file));

            $cliente->dni_anverso = $nombre_archivo;
            $cliente->save();

            return [
                'ok' => 1,
                'mensaje' => 'DNI Anverso del Cliente fue subido satisfactoriamente',
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

     /**
     * subir contrato pdf
     * @param Request $request
     *
     * @return [type]
     */
    public static function  uploadDniReverso(Request $request)
    {
        try {
            $cliente  = Self::find($request->cliente_id);

            $persona_dni = Persona::where('id',$cliente->persona_id)->first()->numero_documento;

            $file = $request->file('dni_reverso');
            $nombre_archivo = "DNI_REVERSO_".date('Y').".".$file->extension();

            Storage::disk('clientes')->put($persona_dni."/".$nombre_archivo,File::get($file));

            $cliente->dni_reverso = $nombre_archivo;
            $cliente->save();

            return [
                'ok' => 1,
                'mensaje' => 'DNI Reverso del Cliente fue subido satisfactoriamente',
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
