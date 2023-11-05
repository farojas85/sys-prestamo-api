<?php

namespace Database\Seeders;

use App\Models\EstadoOperacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoOperacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estado = EstadoOperacion::firstOrCreate(['nombre' => 'Generado' ,'clase'=> 'badge badge-danger']);
        $estado = EstadoOperacion::firstOrCreate(['nombre' => 'Pendiente' ,'clase'=> 'badge badge-warning']);
        $estado = EstadoOperacion::firstOrCreate(['nombre' => 'Pagado' ,'clase'=> 'badge badge-success']);
        $estado = EstadoOperacion::firstOrCreate(['nombre' => 'Anulado' ,'clase'=> 'badge badge-secondary']);
        $estado = EstadoOperacion::firstOrCreate(['nombre' => 'Eliminado' ,'clase'=> 'badge bg-purple']);
    }
}
