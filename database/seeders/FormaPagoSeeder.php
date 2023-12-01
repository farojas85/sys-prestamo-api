<?php

namespace Database\Seeders;

use App\Models\FormaPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormaPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormaPago::firstOrCreate(['nombre' => 'EFECTIVO']);
        FormaPago::firstOrCreate(['nombre' => 'BILLETERA DIGITAL']);
        FormaPago::firstOrCreate(['nombre' => 'DEPOSITO A CTA. CORRIENTE']);
    }
}
