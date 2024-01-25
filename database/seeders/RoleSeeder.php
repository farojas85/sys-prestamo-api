<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\TipoAcceso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $acceso_total = TipoAcceso::select('id')->where('slug','acceso-total')->first()->id;
        $acceso_parcial =TipoAcceso::select('id')->where('slug','acceso-parcial')->first()->id;
        $acceso_denegado =TipoAcceso::select('id')->where('slug','acceso-denegado')->first()->id;

        Role::firstOrCreate([ 'nombre' => 'Super Usuario', 'slug' => 'super-usuario','tipo_acceso_id'=> $acceso_total]);
        Role::firstOrCreate([ 'nombre' => 'Gerente', 'slug' => 'gerente','tipo_acceso_id'=> $acceso_parcial ]);
        Role::firstOrCreate([ 'nombre' => 'Lider Superior', 'slug' => 'lider-superior','tipo_acceso_id'=> $acceso_parcial ]);
        Role::firstOrCreate([ 'nombre' => 'Lider', 'slug' => 'lider','tipo_acceso_id'=> $acceso_parcial ]);
        Role::firstOrCreate([ 'nombre' => 'Invitado', 'slug' => 'invitado','tipo_acceso_id'=> $acceso_denegado, 'es_activo' => 0 ]);
        Role::firstOrCreate([ 'nombre' => 'Inversionista','slug' => 'inversionista','tipo_acceso_id'=> $acceso_parcial]);
    }
}
