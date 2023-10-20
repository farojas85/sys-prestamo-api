<?php
namespace App\Traits;

use App\Models\Menu;

trait MenuTrait
{
    /**
     * The max Padre_id of the menus
     * @return [type]
     */
    public static function maximoPadreId(): int
    {
        $maxOrden = Menu::whereNull('padre_id')->max('orden');

        return ($maxOrden == null && $maxOrden == '') ? 0 : ($maxOrden + 1);
    }

    /**
     * the max submenu of the menus
     * @param mixed $padre_id
     *
     * @return [type]
     */
    public static function maximoHijoId($padre_id): int
    {
        $maxOrden = Menu::where('padre_id',$padre_id)->max('orden');
        return ($maxOrden == null || $maxOrden == '') ? 0 : ($maxOrden + 1);
    }
}
