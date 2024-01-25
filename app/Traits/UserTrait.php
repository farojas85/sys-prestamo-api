<?php
namespace App\Traits;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

trait UserTrait
{
    /**
     * get User by name
     * @param string $name
     *
     * @return [type]
     */
    public static function getByName(string $name) {
        return self::where('name',$name)->first();
    }

    public static function getDataById(int $id) {
        $usuario = self::with(['roles' => function($query) {
                        $query->select('roles.id','roles.nombre','roles.slug');
                    }])
                    ->join('empleados as emp','emp.user_id','=','users.id')
                    ->join('personas as pe','pe.id','=','emp.persona_id')
                    ->join('tipo_documentos as tp','tp.id','=','pe.tipo_documento_id')
                    ->join('sexos as se','se.id','=','pe.sexo_id')
                    ->select(
                        'users.id','users.name','users.foto','users.es_activo',
                        'pe.nombres','pe.apellido_paterno','pe.apellido_materno',
                        'pe.telefono','pe.direccion','tipo_documento_id','numero_documento',
                        'tp.nombre_corto as tipo_documento','sexo_id','se.nombre as sexo',
                        'users.forzar_cambio_clave'
                    )
                    ->where('users.id',$id)
                    ->first()
        ;
        if(is_null($usuario))
        {
            $usuario = self::with(['roles' => function($query) {
                            $query->select('roles.id','roles.nombre','roles.slug');
                        }])
                        ->join('inversionistas as emp','emp.user_id','=','users.id')
                        ->join('personas as pe','pe.id','=','emp.persona_id')
                        ->join('tipo_documentos as tp','tp.id','=','pe.tipo_documento_id')
                        ->join('sexos as se','se.id','=','pe.sexo_id')
                        ->select(
                            'users.id','users.name','users.foto','users.es_activo',
                            'pe.nombres','pe.apellido_paterno','pe.apellido_materno',
                            'pe.telefono','pe.direccion','tipo_documento_id','numero_documento',
                            'tp.nombre_corto as tipo_documento','sexo_id','se.nombre as sexo',
                            'users.forzar_cambio_clave'
                        )
                        ->where('users.id',$id)
                        ->first()
            ;
        }

        $permisos = [];
        $menus = [];

        $menus = Menu::getMenus($usuario->id,true);
        $permisos =  User::obtenerPermisos($usuario->roles[0]->id)->toArray();

        $url_foto = ($usuario->foto == 'foto.png') ?
            Storage::url('usuarios/foto.png') : Storage::url('usuarios/'.$usuario->foto)
            //'usuarios/foto.webp' : 'usuarios/'.$usuario->id."/".$usuario->foto
        ;

        $usuario->menus = $menus;
        $usuario->permisos = $permisos;
        $usuario->foto = $url_foto;

        // $secret = env('VITE_SECRET_KEY');
        // $data = ['usuario' => $usuario];
        // $jwt = JWT::encode($data,$secret,'HS512');
        // return response()->json($jwt,200);

        return $usuario;
    }
}
