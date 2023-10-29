<?php
namespace App\Services\ApiDniRuc\Estrategias;


use App\Models\Persona;
use App\Services\ApiDniRuc\Estrategias\Estrategia;
use App\Services\ApiDniRuc\Models\PersonaDni;
use Peru\Jne\DniFactory;

class PersonaDniEstrategia implements Estrategia
{
    public function obtener(Persona $persona)
    {
        $factoria = new DniFactory();
        $consulta = $factoria->create();


        return json_encode($respuestaData = $consulta->get($persona->numero_documento));

        $personaDni = new PersonaDni();

        if(!$respuestaData)
        {
            return json_encode($personaDni);
        }

        return json_encode( new PersonaDni(
            $respuestaData['dni'],
            $respuestaData['nombres'],
            $respuestaData['apellidoPaterno'],
            $respuestaData['apellidoMaterno'],
            $respuestaData['codVerifica']
        ));

    }
}
