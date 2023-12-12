<?php
namespace App\Traits;

use App\Models\Cuota;
use App\Models\Empleado;
use App\Models\EstadoOperacion;
use App\Models\RegistroPagoDetalle;
use App\Models\Serie;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait RegistroPagoTrait
{
    public static function saveData(Request $request)
    {

        try {

            $forma_pago_medio_pago = DB::table('forma_pago_medio_pago as fpmp')
                                    ->where('forma_pago_id',$request->forma_pago)
                                    ->where('medio_pago_id',$request->medio_pago)
                                    ->select('id')
                                    ->first()
            ;
            $estado_operacion = EstadoOperacion::select('id')->where('nombre','Pre-Pagado')->first();

            //guardamos el regisro
            $registro = new Self();
            $registro->fecha = Carbon::now();
            $registro->prestamo_id = $request->prestamo_id;
            $registro->forma_pago_medio_pago_id = $forma_pago_medio_pago->id;
            $registro->total = $request->total;
            $registro->descuento = 0;
            $registro->user_id = $request->user_id;
            $registro->numero_operacion = $request->numero_operacion;
            $registro->fecha_deposito = $request->fecha_deposito;
            $registro->estado_operacion_id = $estado_operacion->id;

            $registro->save();

            //Guardamos el Voucher si lo hubiera
            if($request->file('imagen_voucher'))
            {
                $file = $request->file('imagen_voucher');
                $nombre_archivo = "VOUCHER_".$registro->id.".".$file->extension();

                Storage::disk('registro-pagos')->put($registro->id."/".$nombre_archivo,File::get($file));

                $registro->imagen_voucher = $nombre_archivo;
                $registro->save();
            }

            //guardamos el Detalle
            if($request->detalles)
            {
                foreach(json_decode($request->detalles) as $detalle)
                {
                    $registro_detalle = new RegistroPagoDetalle();
                    $registro_detalle->registro_pago_id = $registro->id;
                    $registro_detalle->cuota_id = $detalle->id;
                    $registro_detalle->monto_pagar = $detalle->monto_pagar;
                    $registro_detalle->monto_pagado = $detalle->monto_pagado;
                    $registro_detalle->saldo = $detalle->saldo;


                    $suma_detalle_pago = RegistroPagoDetalle::where('cuota_id',$detalle->id)->sum('monto_pagado');

                    $cuota = Cuota::where('id',$detalle->id)->first();

                    $estado_operacion = EstadoOperacion::select('id')->where('nombre','Pre-Pagado')->first();
                    $cuota->estado_operacion_id = $estado_operacion->id;
                    $cuota->save();

                    $registro_detalle->save();
                }
            }

            return [
                'ok' => 1,
                'mensaje' => 'El pago fue registrado satisdactoriamente',
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
     * @param Request $request
     *
     * @return [type]
     */
    public static function historialPagosWithPagination(Request $request)
    {
        $user = $request->user;
        $role = $request->role;
        $empleado_id =  Empleado::where('user_id',$user)->first()->id;


        return Self::join('registro_pago_detalles as rpd','rpd.registro_pago_id','=','registro_pagos.id')
                ->join('cuotas as cu','cu.id','=','rpd.cuota_id')
                ->join('prestamos as pe','pe.id','=','registro_pagos.prestamo_id')
                ->join('clientes as cli','cli.id','=','pe.cliente_id')
                ->join('personas as per','per.id','=','cli.persona_id')
                ->join('empleados as emp','emp.id','=','cli.empleado_id')
                ->join('personas as pemp','pemp.id','=','emp.persona_id')
                ->join('users as usp','usp.id','=','emp.user_id')
                ->join('forma_pago_medio_pago as fpmp','registro_pagos.forma_pago_medio_pago_id','=','fpmp.id')
                ->join('forma_pagos as fp','fp.id','=','fpmp.forma_pago_id')
                ->join('medio_pagos as mp','mp.id','=','fpmp.medio_pago_id')
                ->join('estado_operaciones as eo','eo.id','=','registro_pagos.estado_operacion_id')
                ->leftJoin('series as ser','ser.id','=','registro_pagos.serie_id')
                ->select(
                    'registro_pagos.id',DB::Raw("date_format(registro_pagos.fecha,'%d/%m/%Y') as fecha"),'registro_pagos.total',
                    DB::Raw("
                        CASE
                            WHEN registro_pagos.serie_id IS NOT NULL THEN concat(ser.nombre,'-',numero)
                            ELSE '--'
                        END as serie_numero
                    "),
                    'cu.descripcion as cuota',
                    DB::Raw("substring(concat(upper(per.apellido_paterno),' ',upper(per.apellido_materno),', ',upper(per.nombres)),1,28) as cliente"),
                    'pe.capital_inicial as prestamo_detalle',
                    DB::Raw("concat(upper(pemp.apellido_paterno),' ',upper(pemp.apellido_materno),', ',upper(pemp.nombres)) as lider"),
                    'fp.nombre as forma_pago','mp.nombre as medio_pago',
                    DB::Raw("date_format(registro_pagos.fecha_deposito,'%d/%m/%Y') as fecha_deposito"),
                    'registro_pagos.numero_operacion','eo.nombre as estado_operacion', 'usp.name as user_name',
                    'rpd.cuota_id','cu.monto_cuota','cu.numero_cuota','pe.numero_cuotas'
                )
                ->where(function($query) use($role,$user,$empleado_id){
                    if($role =='lider')
                    {
                        $query->where('cli.empleado_id',$empleado_id);
                    }
                    else if($role == 'lider-superior') {
                        $query->whereIn('cli.empleado_id', function($q) use($user){
                            $q->select('empleados.id')->from('empleados')
                                    ->join('empleados as super','super.id','=','empleados.superior_id')
                                    ->where('super.user_id',$user);
                        })
                        ->orWhere('cli.empleado_id',$empleado_id);
                    }
                })
                ->orderBy('registro_pagos.created_at','desc')
                ->paginate($request->paginacion)
        ;
    }

    /**
     * @param int $id
     *
     * @return [type]
     */
    public static function getDatabyId(int $id)
    {
        return Self::find($id);
    }

    public static function aceptarPago(Request $request)
    {
        DB::beginTransaction();

        try {
            $registro_pago = Self::find($request->id);

            //EL PAGO modificamos a estado Pagado y generamos serie y número

            $estado_operacion = EstadoOperacion::select('id')->where('nombre','Pagado')->first();

            $serie = Serie::where('es_activo',1)->first();

            $numero = Self::where('serie_id',$serie->id)->max('numero');

            $numero = ($numero == null || $numero == '' || is_null($numero)) ? 1 : $numero + 1;

            $registro_pago->serie_id = $serie->id;
            $registro_pago->numero = $numero;
            $registro_pago->estado_operacion_id = $estado_operacion->id;
            $registro_pago->save();


            /* MODIFICAMOS LA CUOTA
             * Si la suma del monto Pagado es menor que el monto pagar se queda en estado Pendiente
             * Si la suma del monto Pagado es = al monto pagar pasa a estado Pagado
            */

            $cuota = Cuota::find($request->cuota_id);

            $registro_detalle_suma = RegistroPagoDetalle::where('cuota_id',$request->cuota_id)
                                        ->sum('monto_pagado')
            ;

            $estado_pendiente = EstadoOperacion::select('id')->where('nombre','Pendiente')->first();
            $estado_pagado = EstadoOperacion::select('id')->where('nombre','Pagado')->first();

            if($registro_detalle_suma< $cuota->monto_cuota)
            {
                $cuota->estado_operacion_id = $estado_pendiente->id;
                $cuota->save();
            }

            if($registro_detalle_suma == $cuota->monto_cuota)
            {
                $cuota->estado_operacion_id = $estado_pagado->id;
                $cuota->save();
            }

            DB::commit();

            return array(
                'ok' => 1,
                'mensaje' => "El pago fue aceptado ha sido registrado satisfactoriamente",
                'data' => $registro_pago
            );
        } catch (Exception $ex) {
            DB::rollBack();

            return [
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            ];
        }

    }
}
