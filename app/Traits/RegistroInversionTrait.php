<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait RegistroInversionTrait
{
    /**
     * @param Request $request
     *
     * @return [type]
     */
    public static function getAllPagination(Request $request)
    {
        return Self::join('inversionistas as inv','inv.id','=','registro_inversiones.inversionista_id')
                ->select('registro_inversiones.id','registro_inversiones.fecha')
                ->orderBy('registro_inversiones.created_at','desc')
                ->paginate($request->paginacion);
    }
}
