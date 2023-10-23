<?php

namespace Database\Seeders;

use App\Models\Moneda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moneda = Moneda::firstOrCreate([
            'codigo' => 'PEN','nombre' => 'Soles',
            'pais' => 'Perú','simbolo' => null
        ]);
        $moneda = Moneda::firstOrCreate([
            'codigo' => 'USD','nombre' => 'US Dollar',
            'pais' => 'Estados Unidos','simbolo' => 'fa fa-dollar'
        ]);
        $moneda = Moneda::firstOrCreate([
            'codigo' => 'EUR','nombre' => 'Euro',
            'pais' => 'Unión Europea','simbolo' =>'fa fa-euro'
        ]);
    }
}
