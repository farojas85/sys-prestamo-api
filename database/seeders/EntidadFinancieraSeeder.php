<?php

namespace Database\Seeders;

use App\Models\EntidadFinanciera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntidadFinancieraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EntidadFinanciera::firstOrCreate(['codigo' => '01', 'nombre' => 'BANCO BCPR', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '02', 'nombre' => 'BCP', 'es_activo'=> 1]);
        EntidadFinanciera::firstOrCreate(['codigo' => '03', 'nombre' => 'BANCO INTERNACIONAL DEL PERU', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '05', 'nombre' => 'BANCO LATINO', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '07', 'nombre' => 'BANCO CITIBANK DEL PERU S.A.', 'es_activo'=> 1]);
        EntidadFinanciera::firstOrCreate(['codigo' => '08', 'nombre' => 'BANCO STANDARD CHARTERED', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '09', 'nombre' => 'BANCO SCOTIABANK PERU', 'es_activo'=> 1]);
        EntidadFinanciera::firstOrCreate(['codigo' => '11', 'nombre' => 'BANCO BBVA', 'es_activo'=> 1]);
        EntidadFinanciera::firstOrCreate(['codigo' => '12', 'nombre' => 'BANCO DE LIMA', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '16', 'nombre' => 'BANCO MERCANTIL', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '18', 'nombre' => 'BANCO DE LA NACION', 'es_activo'=> 1]);
        EntidadFinanciera::firstOrCreate(['codigo' => '22', 'nombre' => 'BANCO SANTANDER CENTRAL HISPANO', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '23', 'nombre' => 'BANCO DE COMERCIO', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '25', 'nombre' => 'BANCO REPUBLICA', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '26', 'nombre' => 'BANCO NBK BANK', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '29', 'nombre' => 'BANCO BANCOSUR', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '35', 'nombre' => 'BANCO FINANCIERO DEL PERU', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '37', 'nombre' => 'BANCO DEL PROGRESO', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '38', 'nombre' => 'BANCO INTERAMERICANO FINANZAS', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '39', 'nombre' => 'BANCO BANEX', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '40', 'nombre' => 'BANCO NUEVO MUNDO', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '41', 'nombre' => 'BANCO SUDAMERICANO', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '42', 'nombre' => 'BANCO DEL LIBERTADOR', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '43', 'nombre' => 'BANCO DEL TRABAJO', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '44', 'nombre' => 'BANCO SOLVENTA', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '45', 'nombre' => 'BANCO SERBANCO SA.', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '46', 'nombre' => 'BANK OF BOSTON', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '47', 'nombre' => 'BANCO ORION', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '48', 'nombre' => 'BANCO DEL PAIS', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '49', 'nombre' => 'BANCO MI BANCO', 'es_activo'=> 1]);
        EntidadFinanciera::firstOrCreate(['codigo' => '50', 'nombre' => 'BANCO BNP PARIBAS', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '51', 'nombre' => 'BANCO AGROBANCO', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '53', 'nombre' => 'BANCO HSBC BANK PERU S.A.', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '54', 'nombre' => 'BANCO FALABELLA S.A.', 'es_activo'=> 1]);
        EntidadFinanciera::firstOrCreate(['codigo' => '55', 'nombre' => 'BANCO RIPLEY', 'es_activo'=> 1]);
        EntidadFinanciera::firstOrCreate(['codigo' => '56', 'nombre' => 'BANCO SANTANDER PERU S.A.', 'es_activo'=> 0]);
        EntidadFinanciera::firstOrCreate(['codigo' => '57', 'nombre' => 'BANCO AZTECA DEL PERU', 'es_activo'=> 10]);
        EntidadFinanciera::firstOrCreate(['codigo' => '58', 'nombre' => 'BANCO INTERBANK', 'es_activo'=> 1]);
        EntidadFinanciera::firstOrCreate(['codigo' => '59', 'nombre' => 'BANCO PICHINCHA', 'es_activo'=> 1]);
        EntidadFinanciera::firstOrCreate(['codigo' => '99', 'nombre' => 'OTROS', 'es_activo'=> 1]);

    }
}
