<?php
namespace App\Traits;

use App\Models\Cuota;
use App\Models\EstadoOperacion;
use App\Models\RegistroPagoDetalle;
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
            $estado_operacion = EstadoOperacion::select('id')->where('nombre','Pendiente')->first();

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

                    if($detalle->monto_pagado == $detalle->monto_pagar )
                    {
                        $cuota = Cuota::where('id',$detalle->id)->first();

                        if($cuota->estado_operacion_id == 2)
                        {
                            $estado_operacion = EstadoOperacion::select('id')->where('nombre','Pagado')->first();
                            $cuota->estado_operacion_id = 3;
                            $cuota->save();
                        }
                    }

                    $registro_detalle->save();
                }
            }

            return [
                'ok' => 1,
                'mensaje' => 'El pago fue registrado satisdactoriamente satisfactoriamente',
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
