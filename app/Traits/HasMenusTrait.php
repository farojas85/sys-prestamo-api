<?php
namespace App\Traits;
use App\Models\Menu;

trait HasMenusTrait

{
    public function asignarMenus($menus)
    {
        if(is_array($menus))
        {
            $this->menus()->sync($menus);
        } else{
            if(count($this->menus) == 0){
                $this->menus()->attach($menus);
            } else {
                foreach($this->menus as $menu)
                {
                    if($menu->id != $menus)
                    {
                        $this->menus()->attach($menus);
                    }
                }
            }
        }
    }

    public static function obtenerMenus($roles)
    {
        return Menu::join('menu_role as mr','menus.id','=','mr.menu_id')
                        ->select('menus.id','menus.nombre','menus.slug','menus.icono')
                        ->where('mr.role_id',$roles)
                        ->orderBy('menus.id','asc')->get();
    }
}
