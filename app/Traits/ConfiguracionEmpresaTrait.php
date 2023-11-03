<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait ConfiguracionEmpresaTrait
{
    /**
     * get
     * @return [type]
     */
    public static function getData()
    {
        return Self::first();
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

            $configuracion_empresa = self::first();

            $configuracion_empresa->nombre = $request->nombre;
            $configuracion_empresa->direccion = $request->direccion;
            $configuracion_empresa->telefono = $request->telefono;
            $configuracion_empresa->correo_corporativo = $request->correo_corporativo;
            $configuracion_empresa->moneda_id = $request->moneda_id;
            $configuracion_empresa->save();

            return array(
                'ok' => 1,
                'mensaje' => 'Las configuraciones de empresa ha sido modificada satisfactoriamente',
                'data' => $configuracion_empresa
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
