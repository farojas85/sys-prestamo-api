<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Aplicación Interés Trait
 */
trait ClienteCuentaTrait
{
    /**
     * @param int $cliente_id
     *
     * @return Data QueryBuilder
     */
    public static function getListByClienteId(int $cliente_id)
    {
        return Self::join('entidad_financieras as ef','ef.id','=','cliente_cuentas.entidad_financiera_id')
                    ->select('cliente_cuentas.id','ef.nombre as banco','cliente_cuentas.numero_cuenta')
                    ->where('cliente_id',$cliente_id)
                    ->get();
    }
}
