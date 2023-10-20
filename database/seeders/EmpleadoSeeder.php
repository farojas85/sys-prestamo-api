<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\Persona;
use App\Models\Role;
use App\Models\Sexo;
use App\Models\TipoDocumento;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sexo = Sexo::select('id')->where('codigo',1)->first()->id;

        $tipo_documento = TipoDocumento::select('id')->where('tipo','0')->first()->id;

        $role = Role::select('id')->where('slug','super-usuario')->first()->id;

        $persona = Persona::firstOrCreate([
            'tipo_documento_id' => $tipo_documento,
            'numero_documento' => '00000000',
            'nombres' => 'ADMIN',
            'apellido_paterno' => 'MASTER',
            'apellido_materno' => 'MASTER',
            'sexo_id' => $sexo,
        ]);

        $user = User::firstOrCreate([
            'name' => 'admin',
            'email' => 'admin@me.com',
            'password' => Hash::make('123456789'),
            'foto' => 'foto.png'
        ]);

        //enlazar el rol con el usuario
        $user->roles()->sync([$role]);

        $empleado = Empleado::firstOrCreate([
            'persona_id' => $persona->id,
            'user_id' => $user->id
        ]);
    }
}
