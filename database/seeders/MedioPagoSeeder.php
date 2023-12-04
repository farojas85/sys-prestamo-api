<?php

namespace Database\Seeders;

use App\Models\FormaPago;
use App\Models\MedioPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedioPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $efectivo = MedioPago::firstOrCreate(['nombre' => 'EFECTIVO']);
        $yape = MedioPago::firstOrCreate(['nombre' => 'YAPE']);
        $plin = MedioPago::firstOrCreate(['nombre' => 'PLIN']);
        $tunki = MedioPago::firstOrCreate(['nombre' => 'TUNKI']);
        $agora = MedioPago::firstOrCreate(['nombre' => 'AGORA PAY']);
        $bim = MedioPago::firstOrCreate(['nombre' => 'BIM']);
        $bcp = MedioPago::firstOrCreate(['nombre' => 'BCP']);
        $bbva = MedioPago::firstOrCreate(['nombre' => 'BBVA']);
        $scotiabank = MedioPago::firstOrCreate(['nombre' => 'SCOTIABANK']);
        $nacion = MedioPago::firstOrCreate(['nombre' => 'BANCO DE LA NACION']);
        $interbank = MedioPago::firstOrCreate(['nombre' => 'INTERBANK']);
        $mibanco = MedioPago::firstOrCreate(['nombre' => 'MIBANCO']);

        $forma_efectivo = FormaPago::select('id')->where('nombre','EFECTIVO')->first();
        $billetera = FormaPago::select('id')->where('nombre','BILLETERA DIGITAL')->first();
        $deposito = FormaPago::select('id')->where('nombre','DEPOSITO A CTA. CORRIENTE')->first();

        $forma_efectivo->medio_pagos()->sync([$efectivo->id]);
        $billetera->medio_pagos()->sync([$yape->id,$plin->id,$tunki->id,$agora->id,$bim->id]);
        $deposito->medio_pagos()->sync([$bcp->id,$bbva->id,$scotiabank->id,$nacion->id,$interbank->id,$mibanco->id]);
    }
}
