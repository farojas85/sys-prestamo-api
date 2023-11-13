<?php

namespace Database\Seeders;

use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbigeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = fopen(base_path('database/data/geodir-ubigeo-inei.csv'), 'r');

        //CONTANDO LAS FILAS DEL ARCHIVO
        $nro_registros = -1;
        while (($datum = fgetcsv($csv, 555, ',')) !== false)
        {
            $nro_registros +=1;
        }

        fclose($csv);
        $this->command->getOutput()->writeln('Iniciando Importación de Ubigeo...');

        DB::unprepared("SET FOREIGN_KEY_CHECKS = 0;");
        DB::unprepared("TRUNCATE table distritos;");
        DB::unprepared("ALTER TABLE distritos auto_increment =1");
        $this->command->getOutput()->writeln('Datos Limpiados de Distritos...');

        DB::unprepared("TRUNCATE table provincias;");
        DB::unprepared("ALTER TABLE provincias auto_increment =1");
        $this->command->getOutput()->writeln('Datos Limpiados de Provincias');

        DB::unprepared("TRUNCATE table departamentos;");
        DB::unprepared("ALTER TABLE departamentos auto_increment =1");
        $this->command->getOutput()->writeln('Datos Limpiados de Departamentos');
        DB::unprepared("SET FOREIGN_KEY_CHECKS = 1;");

        $csv2 = fopen(base_path('database/data/geodir-ubigeo-inei.csv'), 'r');
        $c=0;
        $progressBar = $this->command->getOutput()->createProgressBar($nro_registros);

        $this->command->getOutput()->writeln("Importando Datos de Ubigeo... ");
        $progressBar->start();

        $c=0;
        while (($data = fgetcsv($csv2, 1000, ',')) !== false)
        {
            if($c>0)
            {
                $cod_departamento =substr($data[0],0,2);
                $cod_provincia = substr($data[0],0,4);
                $cod_distrito = $data[0];
                // $depa="F";$prov="F";$dist="F";

                // $depa = 'F';
                $departamento =Departamento::where('codigo',$cod_departamento)->first();
                if(!$departamento)
                {
                    $departamento = Departamento::Create([
                        'codigo' => $cod_departamento,
                        'nombre' => $data[3]
                    ]);
                    // $depa='I';
                }

                // $prov = 'F';
                $provincia = Provincia::where('codigo',$cod_provincia)->first();
                if(!$provincia)
                {
                    $provincia = Provincia::Create([
                        'codigo' => $cod_provincia,
                        'departamento_id' => $departamento->id,
                        'nombre' => $data[2]
                    ]);

                    // $prov = 'I';
                }

                // $dist = 'F';
                $distrito = Distrito::where('codigo', $cod_distrito)->first();
                if(!$distrito)
                {
                    $distrito  = Distrito::Create([
                        'codigo' => $cod_distrito,
                        'provincia_id' => $provincia->id,
                        'nombre' => $data[1]
                    ]);
                    // $dist = 'I';

                }
                $c+=1;


                usleep(2000);
                //$this->command->getOutput()->writeln($data[3].'-'.$depa." ".$data[2]."-".$prov." ".$data[1]."-".$dist);
                $progressBar->advance();
            }
            $c++;
        }
        fclose($csv2);
        $progressBar->finish();
        $this->command->getOutput()->writeln("");
        $this->command->getOutput()->writeln("Importación Finalizada");
    }
}
