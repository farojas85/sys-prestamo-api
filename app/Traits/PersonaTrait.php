<?php
namespace App\Traits;

use App\Services\ApiDniRuc\ApiDniRuc;
use App\Models\Persona;

trait PersonaTrait
{

    public static function getDataByNumeroDocumento(string $numeroDocumento)
    {
        return Self::where('numero_documento',$numeroDocumento)->first();
    }

    /**
     * get Datos Dni from Peru-Consult
     * @param string $numero_documento
     *
     * @return [type]
     */
    public static function buscarPersonaDni(string $numero_documento)
    {
        $personaData = Self::getDataByNumeroDocumento($numero_documento);

        $tipo = 1;
        // if($personaData) {
        //     return $personaData;
        // }

        if(!$personaData)
        {
            $apiDniRuc = new ApiDniRuc();
            $persona = new Persona();
            $persona->numero_documento = $numero_documento;

            $personaData = $apiDniRuc->buscar('dni',$persona);
            $tipo = 2;
            //return $personaData;
        }

        return [
            'data' => $personaData,
            'tipo' => $tipo
        ];


    }
}
