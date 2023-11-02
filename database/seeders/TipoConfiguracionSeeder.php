<?php

namespace Database\Seeders;

use App\Models\TipoConfiguracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoConfiguracion::firstOrCreate(['nombre' => 'Tipos de Préstamos']);
        TipoConfiguracion::firstOrCreate(['nombre' => 'Interés']);
        TipoConfiguracion::firstOrCreate(['nombre' => 'Intereses Moratorios']);
        TipoConfiguracion::firstOrCreate(['nombre' => 'Días de cobros']);
        TipoConfiguracion::firstOrCreate(['nombre' => 'Pagos']);
        TipoConfiguracion::firstOrCreate(['nombre' => 'Cantidad de días']);
    }
}
