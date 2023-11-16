<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Tipo Acceso Trait
 */
trait FrecuenciaPagoTrait
{
    /**
     * To get all pagination listing
     * @param Request $request
     *
     * @return [type]
     */
    public static function getAll(Request $request) {
        $buscar = mb_strtoupper($request->buscar);
        return Self::select('id','nombre','dias','valor_interes','es_activo')
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(dias)"),'like','%'.$buscar.'%');
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
        return Self::select('id','nombre','dias','valor_interes','es_activo')
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(dias)"),'like','%'.$buscar.'%');
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
        return Self::select('id','nombre','dias','valor_interes','es_activo')
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(dias)"),'like','%'.$buscar.'%');
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
        return self::select('id','nombre','dias','valor_interes')->where('es_activo',1)->orderBy('id','asc')->get();
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
                'dias' => $request->dias,
                'valor_interes' => $request->valor_interes
            ]);

            return array(
                'ok' => 1,
                'mensaje' => 'La frecuencia de pago '.$request->nombre." ha sido registrada satisfactoriamente",
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
                'dias' => $request->dias,
                'valor_interes' => $request->valor_interes
            ]);

            return array(
                'ok' => 1,
                'mensaje' => 'La frecuencia de pago '.$request->nombre." ha sido modificada satisfactoriamente",
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

    public static function deleteData(int $id)
    {
        try {

            $tipo_acceso = Self::where('id', $id)->delete();

            return array(
                'ok' => 1,
                'mensaje' => 'La frecuencia de pago  ha sido modificada satisfactoriamente',
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
                'mensaje' => 'La frecuencia de pago ha sido inhabilitada satisfactoriamente',
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
                'mensaje' => 'La frecuencia de pago ha sido habilitada satisfactoriamente',
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
