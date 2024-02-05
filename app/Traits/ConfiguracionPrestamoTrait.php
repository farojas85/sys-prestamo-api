<?php
namespace App\Traits;

use App\Models\ConfiguracionPrestamo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait ConfiguracionPrestamoTrait
{
    public static function getDataConfiguracion(string $tipo_configuracion)
    {
        return ConfiguracionPrestamo::join('configuraciones as conf','conf.id','=','configuracion_prestamos.configuracion_id')
                    ->join('tipo_configuraciones as tc','tc.id','=','conf.tipo_configuracion_id')
                    ->select('conf.nombre','valor')
                    ->where('tc.nombre',$tipo_configuracion)
                    ->get();
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

            foreach($request->all() as $tipoConfiguracion)
            {
               foreach($tipoConfiguracion['configuraciones'] as $configuracion)
               {
                    $configuracion_prestamo = self::find($configuracion['configuracion_prestamo']['id']);

                    $configuracion_prestamo->estado = $configuracion['configuracion_prestamo']['estado'];
                    $configuracion_prestamo->valor = $configuracion['configuracion_prestamo']['valor'];
                    $configuracion_prestamo->save();
               }
            }

            return array(
                'ok' => 1,
                'mensaje' => 'Las configuraciones de preśtamo han sido modificadas satisfactoriamente',
                'data' => null
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
