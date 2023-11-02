<?php
namespace App\Services\ApiDniRuc\Estrategias;


use App\Models\Persona;
use App\Services\ApiDniRuc\Api\ApisNet;
use App\Services\ApiDniRuc\Estrategias\Estrategia;
use App\Services\ApiDniRuc\Models\PersonaRuc;

class PersonaRucEstrategia implements Estrategia
{
    public function obtener(Persona $persona)
    {
        $apisNet = new ApisNet();

        return $respuestaData = $apisNet->consultaRuc($persona->numero_documento);

        $personaRuc = new PersonaRuc();

        if(!$respuestaData)
        {
            return json_encode($personaRuc);
        }

        return json_encode($respuestaData );

    }
}
