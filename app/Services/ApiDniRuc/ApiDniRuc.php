<?php

namespace App\Services\ApiDniRuc;

use App\Models\Persona;
use App\Services\ApiDniRuc\Estrategias\PersonaDniEstrategia;

class ApiDniRuc
{
    protected $tipoBusqueda = [
        'dni' => PersonaDniEstrategia::class
    ];

    public function buscar(string $tipoDocumento, Persona $persona)
    {
        $estrategia = new $this->tipoBusqueda[$tipoDocumento];
        $contexto = new Contexto($estrategia);

        return $contexto->ejecutarEstrategia($persona);
    }
}
