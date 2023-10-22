<?php

namespace Database\Seeders;

use App\Models\FrecuenciaPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrecuenciaPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FrecuenciaPago::firstOrCreate(['nombre' => 'Cobro Diario', 'dias' => 1]);
        FrecuenciaPago::firstOrCreate(['nombre' => 'Cobro Semanal', 'dias' => 7]);
        FrecuenciaPago::firstOrCreate(['nombre' => 'Cobro Quincenal', 'dias' => 14]);
        FrecuenciaPago::firstOrCreate(['nombre' => 'Cobro Mensual', 'dias' => 30]);
        FrecuenciaPago::firstOrCreate(['nombre' => 'Pago Único', 'dias' => 0]);
    }
}
