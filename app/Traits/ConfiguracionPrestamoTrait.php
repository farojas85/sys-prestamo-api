<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait ConfiguracionPrestamoTrait
{
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
