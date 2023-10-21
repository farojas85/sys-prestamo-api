<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Permiso;


trait HasPermisosTrait
{
    public static function obtenerPermisos($roles)
    {
        return Permiso::join('permiso_role as pr','permisos.id','=','pr.permiso_id')
                        ->select('permisos.id','permisos.nombre','permisos.slug')
                        ->where('pr.role_id',$roles)->get();
    }

    public function asignarPermisos($permisos)
    {
        if(is_array($permisos))
        {
            $this->permisos()->sync($permisos);
        } else{
            if(count($this->permisos) == 0){
                $this->permisos()->attach($permisos);
            } else {
                foreach($this->permiso as $permiso)
                {
                    if($permiso->id != $permisos)
                    {
                        $this->permisos()->attach($permisos);
                    }
                }
            }
        }
    }
}
