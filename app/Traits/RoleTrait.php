<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Tipo Acceso Trait
 */
trait RoleTrait
{
    /**
     * To get enableds pagination listing
     * @param Request $request
     *
     * @return [type]
     */
    public static function getEnableds(Request $request) {
        $buscar = mb_strtoupper($request->buscar);
        return Self::join('tipo_accesos as ta','ta.id','=','roles.tipo_acceso_id')
                    ->select(
                        'roles.id','roles.nombre','roles.slug',
                        'roles.es_activo','ta.slug as tipo_acceso'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(roles.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(roles.slug)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(ta.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(ta.slug)"),'like','%'.$buscar.'%');
                    })
                    ->orderBy('es_activo','desc')
                    ->paginate($request->paginacion)
        ;
    }

    /**
     * To get deletes pagination listing
     * @param Request $request
     *
     * @return [type]
     */
    public static function getDeletes(Request $request) {
        $buscar = mb_strtoupper($request->buscar);
        return Self::join('tipo_accesos as ta','ta.id','=','roles.tipo_acceso_id')
                    ->select(
                        'roles.id','roles.nombre','roles.slug',
                        'roles.es_activo','ta.slug as tipo_acceso'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(roles.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(roles.slug)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(ta.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(ta.slug)"),'like','%'.$buscar.'%');
                    })
                    ->onlyTrashed()
                    ->orderBy('es_activo','desc')
                    ->paginate($request->paginacion)
        ;
    }

    /**
     * To get all pagination listing
     * @param Request $request
     *
     * @return [type]
     */
    public static function getAll(Request $request) {
        $buscar = mb_strtoupper($request->buscar);
        return Self::join('tipo_accesos as ta','ta.id','=','roles.tipo_acceso_id')
                    ->select(
                        'roles.id','roles.nombre','roles.slug',
                        'roles.es_activo','ta.slug as tipo_acceso'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(roles.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(roles.slug)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(ta.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(ta.slug)"),'like','%'.$buscar.'%');
                    })
                    ->withTrashed()
                    ->orderBy('es_activo','desc')
                    ->paginate($request->paginacion)
        ;
    }

    /**
     * To get actives pagination listing
     * @param Request $request
     *
     * @return [type]
     */
    public static function getActives(Request $request) {
        $buscar = mb_strtoupper($request->buscar);
        return Self::join('tipo_accesos as ta','ta.id','=','roles.tipo_acceso_id')
                    ->select(
                        'roles.id','roles.nombre','roles.slug',
                        'roles.es_activo','ta.slug as tipo_acceso'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(roles.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(roles.slug)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(ta.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(ta.slug)"),'like','%'.$buscar.'%');
                    })
                    ->where('es_activo',1)
                    ->paginate($request->paginacion)
        ;
    }

    /**
     * To get inacives pagination listing
     * @param Request $request
     *
     * @return [type]
     */
    public static function getInactives(Request $request) {
        $buscar = mb_strtoupper($request->buscar);
        return Self::join('tipo_accesos as ta','ta.id','=','roles.tipo_acceso_id')
                    ->select(
                        'roles.id','roles.nombre','roles.slug',
                        'roles.es_activo','ta.slug as tipo_acceso'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(roles.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(roles.slug)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(ta.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(ta.slug)"),'like','%'.$buscar.'%');
                    })
                    ->where('es_activo',0)
                    ->paginate($request->paginacion)
        ;
    }

    /**
     * Store data
     * @param Request $request
     *
     * @return [type]
     */
    public static function storeData(Request $request)
    {
        try {
            $tipo_acceso = Self::create([
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'tipo_acceso_id' => $request->tipo_acceso_id
            ]);

            return array(
                'ok' => 1,
                'mensaje' => 'El rol '.$request->nombre." ha sido registrado satisfactoriamente",
                'data' => $tipo_acceso
            );
        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

    /**
     * Update data
     * @param Request $request
     * @param int $id
     *
     * @return [type]
     */
    public static function updateData(Request $request,int $id)
    {
        try {
            $tipo_acceso = Self::where('id', $id)
                ->update([
                'nombre' => $request->nombre,
                'slug' => $request->slug
            ]);

            return array(
                'ok' => 1,
                'mensaje' => 'El rol '.$request->nombre." ha sido modificado satisfactoriamente",
                'data' => $tipo_acceso
            );
        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

    /**
     * To disable record
     * @param int $id
     *
     * @return [type]
     */
    public static function disableRecord(int $id) {
        try {
            $tipo_acceso = Self::where('id',$id)
                            ->update([
                                'es_activo' => 0
                            ])
            ;
            return array(
                'ok' => 1,
                'mensaje' => 'El rol ha sido inhabilitado satisfactoriamente',
                'data' => $tipo_acceso
            );
        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }
    /**
     * To enable record
     * @param int $id
     *
     * @return [type]
     */
    public static function enableRecord(int $id) {
        try {
            $tipo_acceso = Self::where('id',$id)
                            ->update([
                                'es_activo' => 1
                            ])
            ;
            return array(
                'ok' => 1,
                'mensaje' => 'El rol ha sido habilitado satisfactoriamente',
                'data' => $tipo_acceso
            );
        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }
}
