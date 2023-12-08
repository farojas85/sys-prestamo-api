<?php
namespace App\Traits;


use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait CuotaTrait
{
    public static function getListByPrestamoId(int $prestamo_id)
    {

        $pagosDetalles = DB::table('registro_pago_detalles as rpd')
                            ->select('rpd.cuota_id',
                                        DB::Raw("sum(rpd.monto_pagado) as monto_pagado")
                            )
                            ->groupBy('rpd.cuota_id')
        ;

        return Self::join('estado_operaciones as eo','eo.id','=','cuotas.estado_operacion_id')
                ->leftJoinSub($pagosDetalles,'pagos_detalles',function($join){
                    $join->on('cuotas.id','=','pagos_detalles.cuota_id');
                })
                ->select(
                    'cuotas.id','cuotas.numero_cuota','cuotas.descripcion',
                    DB::Raw("DATE_FORMAT(cuotas.fecha_vencimiento,'%d/%m/%Y') as fecha_vencimiento"),
                    'cuotas.monto_cuota','eo.nombre as estado',
                    'pagos_detalles.monto_pagado'
                )
                ->where('prestamo_id',$prestamo_id)
                ->orderBy('cuotas.fecha_vencimiento','asc')
                ->get()
        ;
    }
}
