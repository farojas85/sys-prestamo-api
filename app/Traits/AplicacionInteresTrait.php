<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Aplicación Interés Trait
 */
trait AplicacionInteresTrait
{
    /**
     * To get all pagination listing
     * @param Request $request
     *
     * @return [type]
     */
    public static function getAll(Request $request) {
        $buscar = mb_strtoupper($request->buscar);
        return Self::select('id','nombre','es_activo')
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(nombre)"),'like','%'.$buscar.'%');
                    })
                    ->orderBy('es_activo','desc')
                    ->orderBy('id','asc')
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
        return Self::select('id','nombre','es_activo')
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(nombre)"),'like','%'.$buscar.'%');
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
        return Self::select('id','nombre','es_activo')
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(nombre)"),'like','%'.$buscar.'%');
                    })
                    ->where('es_activo',0)
                    ->paginate($request->paginacion)
        ;
    }


    /**
     * get listing for selects
     * @return [type]
     */
    public static function getList()
    {
        return self::select('id','nombre')->where('es_activo',1)->orderBy('id','asc')->get();
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
            $aplicacion_interes = Self::create([ 'nombre' => $request->nombre ]);

            return array(
                'ok' => 1,
                'mensaje' => 'La aplicación de interés '.$request->nombre." ha sido registrada satisfactoriamente",
                'data' => $aplicacion_interes
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
            $aplicacion_interes = Self::where('id', $id)->update(['nombre' => $request->nombre]);

            return array(
                'ok' => 1,
                'mensaje' => 'La aplicación de interés '.$request->nombre." ha sido modificada satisfactoriamente",
                'data' => $aplicacion_interes
            );
        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

    public static function deleteData(int $id)
    {
        try {

            $aplicacion_interes = Self::where('id', $id)->delete();

            return array(
                'ok' => 1,
                'mensaje' => 'La aplicación de interés  ha sido eliminada satisfactoriamente',
                'data' => $aplicacion_interes
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
            $aplicacion_interes = Self::where('id',$id)
                            ->update([
                                'es_activo' => 0
                            ])
            ;
            return array(
                'ok' => 1,
                'mensaje' => 'La aplicación de interés ha sido inhabilitada satisfactoriamente',
                'data' => $aplicacion_interes
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
            $aplicacion_interes = Self::where('id',$id)
                            ->update([
                                'es_activo' => 1
                            ])
            ;
            return array(
                'ok' => 1,
                'mensaje' => 'La aplicación de interés ha sido habilitada satisfactoriamente',
                'data' => $aplicacion_interes
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
