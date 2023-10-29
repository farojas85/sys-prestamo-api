<?php
namespace App\Traits;

trait TipoDocumentoTrait
{
    /**
     * @return [type]
     */
    public static function getList()
    {
        return self::select('id','nombre_corto','nombre_largo')->where('es_activo',1)->get();
    }
}
