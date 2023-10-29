<?php
namespace App\Traits;

trait SexoTrait
{
    /**
     * get listing sexos
     * @return [type]
     */
    public static function getList()
    {
        return self::select('id','codigo','nombre')->get();
    }
}
