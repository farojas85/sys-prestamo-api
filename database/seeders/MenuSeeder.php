<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::select('id')->where('slug','super-usuario')->first();

        $menu1 = Menu::firstOrCreate(['nombre' => 'Dashboard','slug' => 'dashboard',
            'icono' => 'fas fa-tachometer-alt fa-fw', 'padre_id' => null,'orden' => 0
        ]);

        $menu6 = Menu::firstOrCreate(['nombre' => 'Sistema','slug' => 'sistema',
        'icono' => 'fab fa-windows fa-fw', 'padre_id' => null,'orden' => 1
        ]);

        $menu7 = Menu::firstOrCreate(['nombre' => 'Configuraciones','slug' => 'configuracion',
            'icono' => 'fas fa-gears fa-fw', 'padre_id' => null,'orden' => 2
        ]);

        $menu8 = Menu::firstOrCreate(['nombre' => 'Empleado','slug' => 'empleado',
            'icono' => 'fas fa-users-line fa-fw', 'padre_id' => null,'orden' => 3
        ]);

        $menu9 = Menu::firstOrCreate(['nombre' => 'Préstamo','slug' => 'prestamo',
            'icono' => 'fas fa-money-bill-alt fa-fw', 'padre_id' => null,'orden' => 4
        ]);

        $menu10 = Menu::firstOrCreate(['nombre' => 'Registro Pago','slug' => 'registro-pago',
            'icono' => 'fas fa-money-check-dollar', 'padre_id' => null,'orden' => 4
        ]);

        $menu11 = Menu::firstOrCreate(['nombre' => 'Inversión','slug' => 'inversion',
            'icono' => 'fas fa-money-bill-wheat', 'padre_id' => null,'orden' => 5
        ]);

        $role1->menus()->sync([
            $menu1->id,$menu6->id, $menu7->id, $menu8->id, $menu9->id,$menu10->id,
            $menu11->id
        ]);

        $role2 = Role::select('id')->where('slug','gerente')->first();

        $role2->menus()->sync([
            $menu1->id, $menu6->id, $menu7->id, $menu8->id, $menu9->id, $menu10->id
        ]);

        $role3 = Role::select('id')->where('slug','lider-superior')->first();

        $role3->menus()->sync([
            $menu1->id, $menu9->id,$menu10->id
        ]);

        $role4 = Role::select('id')->where('slug','lider')->first();

        $role4->menus()->sync([
            $menu1->id, $menu9->id,$menu10->id
        ]);

        $role5 = Role::select('id')->where('slug','inversionista')->first();

        $role5->menus()->sync([
            $menu1->id, $menu11->id
        ]);


    }
}

