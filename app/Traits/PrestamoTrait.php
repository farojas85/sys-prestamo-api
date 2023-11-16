<?php
namespace App\Traits;

use App\Models\Cuota;
use App\Models\EstadoOperacion;
use App\Models\FrecuenciaPago;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait PrestamoTrait
{

    public static function getEnableds(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);

        $user = ($request->role == 'lider' ) ? $request->user : '%';

        return Self::join('clientes as cli','cli.id','=','prestamos.cliente_id')
            ->join('personas as per','per.id','=','cli.persona_id')
        ->select(
            'prestamos.id',
            DB::Raw("date_format(convert(fecha_prestamo,date),'%d/%m/%Y') as fecha_prestamo"),
            DB::Raw("concat(per.nombres,' ',per.apellido_paterno,' ',per.apellido_materno) as cliente"),
            'prestamos.capital_inicial','prestamos.total','prestamos.interes',
            'prestamos.estado_operacion_id as estado'
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
            $prestamo->dias_gracia = $request->dias_gracia;

            $prestamo->aplicacion_mora_id = $request->aplicacion_mora_id;

            $estado = EstadoOperacion::where('nombre','Generado')->first();
            $prestamo->estado_operacion_id = $estado->id;
            $prestamo->save();

            //GENERAMOS LAS CUOTAS;
            $fechaHoy=Carbon::now();
            $fechaInicio = $fechaHoy;
            $fecuencia_pago = FrecuenciaPago::find($prestamo->frecuencia_pago_id);
            $monto_inicial =$prestamo->capital_inicial + ($prestamo->capital_inicial*($prestamo->interes/100));
            $cuota_monto = round($monto_inicial/$prestamo->numero_cuotas,2);

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
                'mensaje' => "El prestamo ha sido registrado satisfactoriamente",
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

        // if($forma_pago == 2)
        // {
        //     $eco = true;
        //     while($eco)
        //     {
        //         $diaSemana = $fechaSiguiente->dayOfWeek;
        //         if($diaSemana == 0 || $diaSemana == 6)
        //         {
        //             $fechaSiguiente = $fechaSiguiente->addDay();
        //         } else {
        //             $eco=false;
        //         }
        //     }
        // }

        return $fechaSiguiente;
    }


}
