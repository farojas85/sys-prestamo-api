<?php

namespace Database\Seeders;

use App\Models\AplicacionInteres;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AplicacionInteresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AplicacionInteres::firstOrCreate(['nombre' => 'Capital Inicial']);
        AplicacionInteres::firstOrCreate(['nombre' => 'Cada Cuota']);
    }
}
