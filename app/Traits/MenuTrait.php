<?php
namespace App\Traits;

use App\Models\Menu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait MenuTrait
{
    /**
     * The max Padre_id of the menus
     * @return [type]
     */
    public static function maximoPadreId(): int
    {
        $maxOrden = Menu::whereNull('padre_id')->max('orden');

        return ($maxOrden == null || $maxOrden == '') ? 0 : ($maxOrden + 1);
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

    /**
     * To get enableds pagination listing
     * @param Request $request
     *
     * @return [type]
     */
    public static function getEnableds(Request $request) {
        $buscar = mb_strtoupper($request->buscar);
        return Self::leftJoin('menus as padre','padre.id','=','menus.padre_id')
                    ->select(
                        'menus.id','menus.nombre','menus.slug','menus.icono','menus.orden',
                        'menus.es_activo','padre.nombre as padre'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(menus.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(menus.slug)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(padre.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(padre.slug)"),'like','%'.$buscar.'%');
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
        return Self::leftJoin('menus as padre','padre.id','=','menus.padre_id')
                    ->select(
                        'menus.id','menus.nombre','menus.slug','menus.icono','menus.orden',
                        'menus.es_activo','padre.nombre as padre'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(menus.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(menus.slug)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(padre.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(padre.slug)"),'like','%'.$buscar.'%');
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
        return Self::leftJoin('menus as padre','padre.id','=','menus.padre_id')
                    ->select(
                        'menus.id','menus.nombre','menus.slug','menus.icono','menus.orden',
                        'menus.es_activo','padre.nombre as padre'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(menus.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(menus.slug)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(padre.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(padre.slug)"),'like','%'.$buscar.'%');
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
        return Self::leftJoin('menus as padre','padre.id','=','menus.padre_id')
                    ->select(
                        'menus.id','menus.nombre','menus.slug','menus.icono','menus.orden',
                        'menus.es_activo','padre.nombre as padre'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(menus.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(menus.slug)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(padre.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(padre.slug)"),'like','%'.$buscar.'%');
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
        return Self::leftJoin('menus as padre','padre.id','=','menus.padre_id')
                    ->select(
                        'menus.id','menus.nombre','menus.slug','menus.icono','menus.orden',
                        'menus.es_activo','padre.nombre as padre'
                    )
                    ->where(function($query) use($buscar){
                        $query->where(DB::Raw("upper(menus.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(menus.slug)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(padre.nombre)"),'like','%'.$buscar.'%')
                            ->orWhere(DB::Raw("upper(padre.slug)"),'like','%'.$buscar.'%');
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

            $orden= ($request->padre_id !='' || $request->padre_id != null) ?
                    Self::maximoHijoId($request->padre_id) : Self::maximoPadreId()
            ;

            $tipo_acceso = Self::create([
                'nombre' => $request->nombre,
                'slug' => $request->slug,
                'icono' => $request->icono,
                'padre_id' => $request->padre_id,
                'orden' => $orden
            ]);

            return array(
                'ok' => 1,
                'mensaje' => 'El menú '.$request->nombre." ha sido registrado satisfactoriamente",
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
                'slug' => $request->slug,
                'icono' => $request->icono,
                'padre_id' => $request->padre_id,
                'orden' => $request->orden
            ]);

            return array(
                'ok' => 1,
                'mensaje' => 'El menú '.$request->nombre." ha sido modificado satisfactoriamente",
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
            $menu = Self::where('id',$id)
                            ->update([
                                'es_activo' => 0
                            ])
            ;
            return array(
                'ok' => 1,
                'mensaje' => 'El menú ha sido inhabilitado satisfactoriamente',
                'data' => $menu
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
            $menu = Self::where('id',$id)
                            ->update([
                                'es_activo' => 1
                            ])
            ;
            return array(
                'ok' => 1,
                'mensaje' => 'El menú ha sido habilitado satisfactoriamente',
                'data' => $menu
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
     * get padres listing
     * @return [type]
     */
    public static function getParents() {
        return Self::whereNull('padre_id')->orderBy('id','asc')->get();
    }
}
