<?php
namespace App\Traits;

use App\Models\AplicacionInteres;
use App\Models\Cliente;
use App\Models\Cuota;
use App\Models\EstadoOperacion;
use App\Models\FrecuenciaPago;
use App\Models\Persona;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait PrestamoTrait
{

    public static function getEnableds(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);

        $user = ($request->role == 'lider' ) ? $request->user : '%';

        return Self::join('clientes as cli','cli.id','=','prestamos.cliente_id')
            ->join('personas as per','per.id','=','cli.persona_id')
            ->leftJoin('estado_operaciones as eop','eop.id','=','prestamos.estado_operacion_id')
        ->select(
            'prestamos.id',
            DB::Raw("date_format(convert(fecha_prestamo,date),'%d/%m/%Y') as fecha_prestamo"),
            DB::Raw("concat(per.nombres,' ',per.apellido_paterno,' ',per.apellido_materno) as cliente"),
            'prestamos.capital_inicial','prestamos.total','prestamos.interes',
            'prestamos.estado_operacion_id as estado',
            'eop.nombre as nombre_operacion','prestamos.contrato_pdf'
        )
        ->where(function($query) use($request) {
            if($request->role =='lider')
            {
                $query->where('prestamos.user_id',$request->user);
            }
        })
        ->orderBy('prestamos.fecha_prestamo','desc')
        ->paginate($request->paginacion);
    }

    public static function getAll(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);

        $user = ($request->role == 'lider' ) ? $request->user : '%';

        return Self::where('prestamos.user_id','like',$user)
                ->orderBy('prestamos.fecha_prestamo','desc')
                ->withTrashed()
                ->paginate($request->paginacion);
    }

    public static function getDeletes(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);

        $user = ($request->role == 'lider' ) ? $request->user : '%';

        return Self::where('prestamos.user_id','like',$user)
                ->orderBy('prestamos.fecha_prestamo','desc')
                ->onlyTrashed()
                ->paginate($request->paginacion);
    }


    public static function getData(int $id)
    {
        try {
            $prestamo = Self::with([
                'estado_operacion:id,nombre',
                'cuotas' => function($query) {
                    $query->select(
                        'cuotas.id','cuotas.numero_cuota','cuotas.descripcion','cuotas.monto_cuota',
                        'cuotas.prestamo_id',
                        DB::Raw("DATE_FORMAT(cuotas.fecha_vencimiento,'%d/%m/%Y') as fecha_vencimiento")
                    )
                    ->orderBy('cuotas.fecha_vencimiento','asc');
                }
            ])
            ->join('clientes as cli','cli.id','=','prestamos.cliente_id')
            ->join('personas as per','per.id','=','cli.persona_id')
            ->select(
                'prestamos.id','prestamos.estado_operacion_id',
                DB::Raw("DATE_FORMAT(prestamos.fecha_prestamo,'%Y-%m-%d') as fecha_prestamo"),
                'prestamos.cliente_id','prestamos.user_id','prestamos.capital_inicial','prestamos.interes',
                'prestamos.numero_cuotas','prestamos.aplicacion_interes_id','prestamos.frecuencia_pago_id',
                'prestamos.total','prestamos.aplicacion_mora_id','prestamos.dias_gracia','prestamos.interes_moratorio',
                'prestamos.observaciones','prestamos.contrato_pdf',
                'per.nombres','per.numero_documento','per.apellido_paterno','per.apellido_materno','per.telefono','per.direccion'
            )
            ->where('prestamos.id',$id)->first();

            return array(
                'ok' => 1,
                'mensaje' => '',
                'data' => $prestamo
            );
        }
        catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

    public static function storeData(Request $request)
    {
        try {

            $prestamo = new self();
            $prestamo->fecha_prestamo = $request->fecha_prestamo." ".date('H:i:s');
            $prestamo->cliente_id = $request->cliente_id;
            $prestamo->user_id = $request->user_id;
            $prestamo->frecuencia_pago_id = $request->frecuencia_pago_id;
            $prestamo->aplicacion_interes_id = $request->aplicacion_interes_id;
            $prestamo->capital_inicial = $request->capital_inicial;
            $prestamo->interes = $request->interes;
            $prestamo->numero_cuotas = $request->numero_cuotas;
            $prestamo->total = $request->total;
            $prestamo->aplicacion_mora_id = $request->aplicacion_mora_id;
            $prestamo->interes_moratorio = $request->interes_moratorio;
            $prestamo->dias_gracia = $request->dias_gracia;

            $estado = EstadoOperacion::where('nombre','Generado')->first();
            $prestamo->estado_operacion_id = $estado->id;
            $prestamo->save();

            //GENERAMOS LAS CUOTAS;
            $fechaHoy=Carbon::now();
            $fechaInicio = $fechaHoy;
            $fecuencia_pago = FrecuenciaPago::find($prestamo->frecuencia_pago_id);

            $monto_inicial =$prestamo->capital_inicial;

            // if($request->aplicacion_interes_id == 1)
            // {
            //     $monto_inicial =$prestamo->capital_inicial + ($prestamo->capital_inicial*($prestamo->interes/100));
            //     $cuota_monto = round($monto_inicial/$prestamo->numero_cuotas,2);
            // }

            // if($request->aplicacion_interes_id == 2)
            // {
            //     $cuota_monto = round(($monto_inicial/$prestamo->numero_cuotas)*(1 + ($prestamo->interes/100)),2);
            // }
            $cuota_monto = $request->valor_cuota;

            for($x=1;$x<=$prestamo->numero_cuotas;$x++)
            {
                $fechaSiguiente = self::obtenerFechaCuota($fechaInicio,$fecuencia_pago);

                $cuota = new Cuota();
                $cuota->prestamo_id =$prestamo->id;
                $cuota->numero_cuota = $x;
                $cuota->descripcion = 'CUOTA '.$x;
                $cuota->fecha_vencimiento = $fechaSiguiente->format('Y-m-d');
                $cuota->monto_cuota = $cuota_monto;
                //$cuota->saldo = $monto_inicial - $cuota_monto;
                $estado = EstadoOperacion::where('nombre','Pendiente')->first();
                $cuota->estado_operacion_id = $estado->id;
                $cuota->save();

                $monto_inicial -= $cuota_monto;
                $fechaInicio = $fechaSiguiente;
            }

            return array(
                'ok' => 1,
                'mensaje' => "El préstamo ha sido registrado satisfactoriamente",
                'data' => $prestamo
            );

        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }


    }

    public static function obtenerFechaCuota($fechaHoy,$tipoCuota,)
    {
        $fechaSiguiente = $fechaHoy;
        if($tipoCuota->dias == 1) {
            $fechaSiguiente = $fechaHoy->addDay();
        } else {
            $fechaSiguiente = $fechaHoy->addDays($tipoCuota->dias);
        }

        return $fechaSiguiente;
    }

    public static function updateData(Request $request)
    {
        try {

            $prestamo = Self::where('id', $request->id)->first();
            $prestamo->fecha_prestamo = $request->fecha_prestamo." ".date('H:i:s');
            $prestamo->cliente_id = $request->cliente_id;
            $prestamo->user_id = $request->user_id;
            $prestamo->frecuencia_pago_id = $request->frecuencia_pago_id;
            $prestamo->aplicacion_interes_id = $request->aplicacion_interes_id;
            $prestamo->capital_inicial = $request->capital_inicial;
            $prestamo->interes = $request->interes;
            $prestamo->numero_cuotas = $request->numero_cuotas;
            $prestamo->total = $request->total;
            $prestamo->aplicacion_mora_id = $request->aplicacion_mora_id;
            $prestamo->interes_moratorio = $request->interes_moratorio;
            $prestamo->dias_gracia = $request->dias_gracia;
            // $estado = EstadoOperacion::where('nombre','Generado')->first();
            // $prestamo->estado_operacion_id = $estado->id;
            $prestamo->save();

            //GENERAMOS LAS CUOTAS;

            $cuotas = Cuota::where('prestamo_id',$prestamo->id)->delete();

            $fechaHoy=Carbon::now();
            $fechaInicio = $fechaHoy;
            $fecuencia_pago = FrecuenciaPago::find($prestamo->frecuencia_pago_id);

            $monto_inicial =$prestamo->capital_inicial;

            $cuota_monto = 0;

            // if($request->aplicacion_interes_id == 1)
            // {
            //     $monto_inicial =$prestamo->capital_inicial + ($prestamo->capital_inicial*($prestamo->interes/100));
            //     $cuota_monto = round($monto_inicial/$prestamo->numero_cuotas,2);
            // }

            // if($request->aplicacion_interes_id == 2)
            // {
            //     $cuota_monto = round(($monto_inicial/$prestamo->numero_cuotas)*(1 + ($prestamo->interes/100)),2);
            // }

            $cuota_monto = $request->valor_cuota;


            for($x=1;$x<=$prestamo->numero_cuotas;$x++)
            {
                $fechaSiguiente = self::obtenerFechaCuota($fechaInicio,$fecuencia_pago);

                $cuota = new Cuota();
                $cuota->prestamo_id =$prestamo->id;
                $cuota->numero_cuota = $x;
                $cuota->descripcion = 'CUOTA '.$x;
                $cuota->fecha_vencimiento = $fechaSiguiente->format('Y-m-d');
                $cuota->monto_cuota = $cuota_monto;
                //$cuota->saldo = $monto_inicial - $cuota_monto;
                $estado = EstadoOperacion::where('nombre','Pendiente')->first();
                $cuota->estado_operacion_id = $estado->id;
                $cuota->save();

                //$monto_inicial -= $cuota_monto;
                $fechaInicio = $fechaSiguiente;
            }

            return array(
                'ok' => 1,
                'mensaje' => "El préstamo ha sido modificado satisfactoriamente",
                'data' => $prestamo
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
     * Cambiar el estado de operacion de un préstamo
     * @param Request $request
     *
     * @return [type]
     */
    public static function cambiarEstadoPrestamo(Request $request)
    {
        try {
            $prestamo = Self::find($request->id);

            $estado_operacion = EstadoOperacion::select('id')->where('nombre',$request->estado)->first();

            $prestamo->estado_operacion_id = $estado_operacion->id;

            if($request->estado=='Observado')
            {
                $prestamo->observaciones = $request->observaciones;
            }

            $prestamo->save();


            return array(
                'ok' => 1,
                'mensaje' => "Estado del préstamo ha sido modificado satisfactoriamente",
                'data' => $prestamo
            );
        }
        catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

    public static function deleteRecord(Request $request)
    {
        try {
            $prestamo = Self::find($request->id);

            $prestamo->forceDelete();

            return array(
                'ok' => 1,
                'mensaje' => "El préstamo ha sido eliminado satisfactoriamente",
                'data' => $prestamo
            );
        }
        catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
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
            $prestamo  = Self::find($request->id);

            $cliente = Cliente::find($prestamo->cliente_id);

            $persona_dni = Persona::where('id',$cliente->persona_id)->first()->numero_documento;

            $file = $request->file('contrato');
            $nombre_archivo = "CONTRATO_".date('Ymd').".".$file->extension();

            Storage::disk('clientes')->put($persona_dni."/".$nombre_archivo,File::get($file));

            $prestamo->contrato_pdf = $nombre_archivo;
            $prestamo->save();

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

    public static function getByClienteId($cliente_id)
    {
        return Self::select('id','fecha_prestamo','capital_inicial','interes')
                ->where('cliente_id',$cliente_id)
                ->orderBy('fercha_prestamo','asc')
                ->get();
    }

}
