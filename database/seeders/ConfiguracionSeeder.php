<?php

namespace Database\Seeders;

use App\Models\Configuracion;
use App\Models\ConfiguracionPrestamo;
use App\Models\TipoConfiguracion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo_prestamo = TipoConfiguracion::select('id')->where(['nombre' => 'Tipos de Préstamos'])->first()->id;
        $interes = TipoConfiguracion::select('id')->where(['nombre' => 'Interés'])->first()->id;
        $interes_moratorio = TipoConfiguracion::select('id')->where(['nombre' => 'Intereses Moratorios'])->first()->id;
        $dia_cobro = TipoConfiguracion::select('id')->where(['nombre' => 'Días de cobros'])->first()->id;
        $pagos = TipoConfiguracion::select('id')->where(['nombre' => 'Pagos'])->first()->id;
        $cantidad_dias = TipoConfiguracion::select('id')->where(['nombre' => 'Cantidad de días'])->first()->id;
        $interes_inversion = TipoConfiguracion::select('id')->where(['nombre' => 'Interés Inversión'])->first()->id;

        $configuracion1 = Configuracion::firstOrCreate([ 'nombre' => 'Frecuencia de Pago' , 'tipo_configuracion_id' => $tipo_prestamo]);

        $prestamo1 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion1->id, 'estado' => 1]);

        $configuracion2 = Configuracion::firstOrCreate([ 'nombre' => 'Selección de Tipo', 'tipo_configuracion_id' => $tipo_prestamo,
            'descripcion' => 'Permite cambiar el tipo de cobro al momento de crear un préstamo']);

        $prestamo2 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion2->id, 'estado' => 1]);

        $configuracion3 = Configuracion::firstOrCreate([ 'nombre' => 'Aplicación de Intereses', 'tipo_configuracion_id' => $interes ]);

        $prestamo3 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion3->id, 'estado' => 2]);

        $configuracion4 = Configuracion::firstOrCreate([ 'nombre' => 'Cambiar aplicación de interés', 'tipo_configuracion_id' => $interes,
            'descripcion' => 'Permite cambiar el tipo de aplicación de interés al momento de crear un préstamo' ]);

        $prestamo4 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion4->id, 'estado' => 1]);

        $configuracion5 =  Configuracion::firstOrCreate([ 'nombre' => 'Interés por defecto', 'tipo_configuracion_id' => $interes ]);

        $prestamo5 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion5->id, 'estado' => null,'valor' => 20.00]);

        $configuracion6 =  Configuracion::firstOrCreate([ 'nombre' => 'Cambiar interés', 'tipo_configuracion_id' => $interes,
            'descripcion' => 'Permite que se pueda cambiar el porcentaje de interés (%) al momento de crear un nuevo préstamo' ]);

        $prestamo6 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion6->id, 'estado' => 1]);

        $configuracion7 = Configuracion::firstOrCreate([ 'nombre' => 'Cálculo de mora', 'tipo_configuracion_id' => $interes_moratorio,
            'descripcion' => 'Permite configurar la aplicación de intereses moratorios a todos los nuevos préstamos'  ]);

        $prestamo7 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion7->id, 'estado' => 0]);

        $configuracion8 = Configuracion::firstOrCreate([ 'nombre' => 'Aplicación de Mora', 'tipo_configuracion_id' => $interes_moratorio ]);

        $prestamo8 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion8->id, 'estado' => 2]);

        $configuracion9 = Configuracion::firstOrCreate([ 'nombre' => 'Interés aplicado al importe de la cuota atrasada', 'tipo_configuracion_id' => $interes_moratorio ]);

        $prestamo9 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion9->id, 'estado' => null, 'valor' => 5.00]);

        $configuracion10 = Configuracion::firstOrCreate([ 'nombre' => 'Cantidad de días que pueda estar atrasado', 'tipo_configuracion_id' => $interes_moratorio ]);

        $prestamo10 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion10->id, 'estado' => null,'valor' => 0.00]);

        $configuracion11 = Configuracion::firstOrCreate([ 'nombre' => 'Días ignorados', 'tipo_configuracion_id' => $dia_cobro ]);

        $prestamo11 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion11->id, 'estado' => null, 'valor' => null]);

        $configuracion12 = Configuracion::firstOrCreate([ 'nombre' => 'Fijar días para el cobro', 'tipo_configuracion_id' => $dia_cobro ]);

        $prestamo12 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion12->id, 'estado' => 0]);

        $configuracion13 = Configuracion::firstOrCreate([ 'nombre' => 'Día Cobro Semanal', 'tipo_configuracion_id' => $dia_cobro ]);

        $prestamo13 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion13->id, 'estado' => 5]);

        $configuracion14 = Configuracion::firstOrCreate([ 'nombre' => 'Día Primera Quincena', 'tipo_configuracion_id' => $dia_cobro ]);

        $prestamo14 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion14->id, 'estado' => null, 'valor' => 10]);

        $configuracion15 = Configuracion::firstOrCreate([ 'nombre' => 'Día Segunda Quincena', 'tipo_configuracion_id' => $dia_cobro ]);

        $prestamo15 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion15->id, 'estado' => null, 'valor' => 25]);

        $configuracion16 = Configuracion::firstOrCreate([ 'nombre' => 'Día Cobro Mensual', 'tipo_configuracion_id' => $dia_cobro ]);

        $prestamo16 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion16 ->id, 'estado' => null, 'valor' => 30]);

        $configuracion17 = Configuracion::firstOrCreate([ 'nombre' => 'Primer Pago', 'tipo_configuracion_id' => $pagos,
            'descripcion' => 'Registra automáticamente el pago de la primera cuota' ]);

        $prestamo17 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion17->id, 'estado' => 0, 'valor' => null]);

        $configuracion18 = Configuracion::firstOrCreate([ 'nombre' => 'Redondeo automático', 'tipo_configuracion_id' => $pagos,
            'descripcion' => 'Las cuotas se redondean a la hora de realizar el pago',
            'observacion' => 'Por ejemplo una cuota de 599.65 se redondeará automáticamente a 600'  ]);

        $prestamo18 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion18->id, 'estado' => 0, 'valor' => null]);

        $configuracion19 = Configuracion::firstOrCreate([ 'nombre' => 'Cantidad de días al mes', 'tipo_configuracion_id' => $cantidad_dias ]);

        $prestamo19 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion19->id, 'estado' => null, 'valor' => 30]);

        $configuracion20 = Configuracion::firstOrCreate([ 'nombre' => 'Cantidad de días para quincenas', 'tipo_configuracion_id' => $cantidad_dias ]);

        $prestamo20 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion20->id, 'estado' => null, 'valor' => 15]);

        $configuracion21 = Configuracion::firstOrCreate([
            'nombre' => 'Interés por defecto', 'tipo_configuracion_id' => $interes_inversion,
            'descripcion' => 'Se aplica un interés mensual para la inversión',
            'observacion' => 'En el dashboard el valor de ganancia de inversión se mostrará en días'
        ]);

        $prestamo21 = ConfiguracionPrestamo::firstOrCreate([ 'configuracion_id' => $configuracion21->id, 'estado' => null, 'valor' => 4.5]);


    }
}
