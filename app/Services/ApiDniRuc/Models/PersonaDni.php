<?php
declare(strict_types=1);

namespace App\Services\ApiDniRuc\Models;

class PersonaDni
{
    public function __construct(
        public string $dni ="",
        public string $nombres ="",
        public string $apellidoPaterno="",
        public string $apellidoMaterno="",
        public int $codVerifica=0
    ) {}

}
