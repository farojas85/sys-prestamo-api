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
        $estado = EstadoOperacion::firstOrCreate(['nombre' => 'Observado' ,'clase'=> 'badge bg-indigo']);
        $estado = EstadoOperacion::firstOrCreate(['nombre' => 'Rechazado' ,'clase'=> 'badge bg-maroon']);
        $estado = EstadoOperacion::firstOrCreate(['nombre' => 'Aceptado' ,'clase'=> 'badge bg-primary']);
        $estado = EstadoOperacion::firstOrCreate(['nombre' => 'Abonado' ,'clase'=> 'badge bg-primary']);
        $estado = EstadoOperacion::firstOrCreate(['nombre' => 'Pre-Pagado' ,'clase'=> 'badge bg-orange']);
        $estado = EstadoOperacion::firstOrCreate(['nombre' => 'Pre-Aprobado' ,'clase'=> 'badge bg-danger']);

    }
}
