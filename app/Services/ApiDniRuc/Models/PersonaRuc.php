<?php
declare(strict_types=1);

namespace App\Services\ApiDniRuc\Models;

class PersonaRuc
{
    public function __construct(
        public string $razonSocial="",
        public int $tipoDocumento=6,
        public string $numeroDocumento ="",
        public string $estado ="",
        public string $condicion="",
        public string $direccion="",
        public string $ubigeo="",
        public string $viaTipo="",
        public string $viaNombre="",
        public string $zonaCodigo='-',
        public string $zonaTipo='-',
        public string $numero="",
        public string $interior="-",
        public string $lote="-",
        public string $dpto="-",
        public string $manzana="-",
        public string $kilometro="-",
        public string $distrito="",
        public string $provincia="",
        public string $departamento="",
        public bool $EsAgenteretencion=false
    ) {}

}
