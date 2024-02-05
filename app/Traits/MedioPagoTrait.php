<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait MedioPagoTrait
{
    /**
     * @param int $forma_pago
     *
     * @return App\Models\MedioPago
     */
    public static function getListByFormaPago(int $forma_pago)
    {
        return Self::select('medio_pagos.id','medio_pagos.nombre')
                ->whereHas('forma_pagos',function($q)use($forma_pago){
                    $q->where('forma_pagos.id',$forma_pago);
                })
                ->where('medio_pagos.es_activo',1)->get()
        ;
    }

    /**
     * @param int $forma_pago
     *
     * @return App\Models\MedioPago
     */
    public function precio_minimo()
    {
        return $this->conversiones()->min('precio');
    }

    public function stock_minimo()
    {
        return $this->conversiones()->min('cantidad');
    }
}
