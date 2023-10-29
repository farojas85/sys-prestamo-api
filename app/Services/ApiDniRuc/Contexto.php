<?php
namespace App\Services\ApiDniRuc;

use App\Models\Persona;
use App\Services\ApiDniRuc\Estrategias\Estrategia;

class Contexto
{
    private $estrategia;

    public function __construct(Estrategia $estrategia)
    {
        $this->estrategia = $estrategia;
    }

    public function  ejecutarEstrategia(Persona $persona)
    {
        return $this->estrategia->obtener($persona);
    }
}
