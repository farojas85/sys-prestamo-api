<?php

namespace Database\Seeders;

use App\Models\TipoAcceso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoAccesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoAcceso::firstOrCreate([ 'nombre' => 'Acceso Total','slug' => 'acceso-total']);
        TipoAcceso::firstOrCreate([ 'nombre' => 'Acceso Parcial','slug' => 'acceso-parcial']);
        TipoAcceso::firstOrCreate([ 'nombre' => 'Acceso Denegado','slug' => 'acceso-denegado']);
    }
}
