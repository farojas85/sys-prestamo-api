<?php
namespace App\Services\ApiDniRuc\Estrategias;

use App\Models\Persona;

interface Estrategia
{
    /**
     * obtener Datos Persona de APi
     * @param Persona $persona
     *
     * @return [type]
     */
    public function obtener(Persona $persona);
}
