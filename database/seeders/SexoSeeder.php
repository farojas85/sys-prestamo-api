<?php

namespace Database\Seeders;

use App\Models\Sexo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sexo::firstOrCreate(['codigo' => 1,'nombre' => 'Masculino' ]);
        Sexo::firstOrCreate(['codigo' => 2,'nombre' => 'Femenino' ]);
    }
}
