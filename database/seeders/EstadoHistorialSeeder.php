<?php

namespace Database\Seeders;

use App\Models\EstadoHistorial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoHistorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estado = EstadoHistorial::firstOrCreate(['nombre' => 'Generado' ,'clase'=> 'badge badge-danger']);
        $estado = EstadoHistorial::firstOrCreate(['nombre' => 'Observado' ,'clase'=> 'badge badge-warning']);
        $estado = EstadoHistorial::firstOrCreate(['nombre' => 'Aceptado' ,'clase'=> 'badge badge-success']);
        $estado = EstadoHistorial::firstOrCreate(['nombre' => 'Rechazado' ,'clase'=> 'badge badge-danger']);
        $estado = EstadoHistorial::firstOrCreate(['nombre' => 'Anulado' ,'clase'=> 'badge bg-secondary']);
    }
}
