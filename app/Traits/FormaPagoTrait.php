<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait FormaPagoTrait
{
    /**
     * @return [type]
     */
    public static function getList()
    {
        return Self::select('id','nombre')->where('es_activo',1)->get();
    }
}
