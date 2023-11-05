<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait PrestamoTrait
{

    public static function getEnableds(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);

        $user = ($request->role == 'lider-superior' ||  $request->role == 'lider' ) ? $request->user : '%';

        return Self::where('prestamos.user_id','like',$user)
                ->orderBy('prestamos.fecha_prestamo','desc')
                ->paginate($request->paginacion);
    }

    public static function getAll(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);

        $user = ($request->role == 'lider-superior' ||  $request->role == 'lider' ) ? $request->user : '%';

        return Self::where('prestamos.user_id','like',$user)
                ->orderBy('prestamos.fecha_prestamo','desc')
                ->withTrashed()
                ->paginate($request->paginacion);
    }

    public static function getDeletes(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);

        $user = ($request->role == 'lider-superior' ||  $request->role == 'lider' ) ? $request->user : '%';

        return Self::where('prestamos.user_id','like',$user)
                ->orderBy('prestamos.fecha_prestamo','desc')
                ->onlyTrashed()
                ->paginate($request->paginacion);
    }


}
