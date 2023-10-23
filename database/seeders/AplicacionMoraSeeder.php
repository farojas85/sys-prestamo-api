<?php

namespace Database\Seeders;

use App\Models\AplicacionMora;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AplicacionMoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AplicacionMora::firstOrCreate(['nombre' => 'Calcular por periodos atrasados.']);
        AplicacionMora::firstOrCreate(['nombre' => 'Fijo']);
    }
}
