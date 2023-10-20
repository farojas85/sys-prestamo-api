<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = TipoDocumento::firstOrCreate(['tipo' =>'1' ,'nombre_largo' => 'Documento Nacional de Identidad',
                                                'nombre_corto' => 'D.N.I/L.E.','longitud' => 8, 'es_activo' => 1])
        ;
        $tipo = TipoDocumento::firstOrCreate(['tipo' =>'4' ,'nombre_largo' => 'Carnet de Extranjería',
                                                'nombre_corto' => 'Carnet Ext.','longitud' => 12, 'es_activo' => 1])
        ;
        $tipo = TipoDocumento::firstOrCreate(['tipo' =>'6' ,'nombre_largo' => 'Registro Único de Contribuyentes',
                                                'nombre_corto' => 'R.U.C','longitud' => 11, 'es_activo' => 0])
        ;
        $tipo = TipoDocumento::firstOrCreate(['tipo' =>'7' ,'nombre_largo' => 'Pasaporte',
                                                'nombre_corto' => 'Pasaporte','longitud' => 12, 'es_activo' => 1])
        ;
        $tipo = TipoDocumento::firstOrCreate(['tipo' =>'A' ,'nombre_largo' => 'Cédula Diplomática de Identidad',
                                                'nombre_corto' => 'Ced. Diplomática','longitud' => 15, 'es_activo' => 0])
        ;
        $tipo = TipoDocumento::firstOrCreate(['tipo' =>'0' ,'nombre_largo' => 'Otros',
                                                'nombre_corto' => 'Otros','longitud' => 15, 'es_activo' => 0])
        ;
    }
}
