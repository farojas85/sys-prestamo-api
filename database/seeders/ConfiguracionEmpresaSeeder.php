<?php

namespace Database\Seeders;

use App\Models\ConfiguracionEmpresa;
use App\Models\Moneda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguracionEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moneda = Moneda::getByCodigo('PEN');

        ConfiguracionEmpresa::firstOrCreate([
            'nombre' =>  'Inversiones SANTE',
            'moneda_id' => $moneda->id
        ]);
    }
}
