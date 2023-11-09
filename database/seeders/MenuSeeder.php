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

        $menu1 = Menu::firstOrCreate(['nombre' => 'Dashboard','slug' => null,
            'icono' => 'fas fa-tachometer-alt fa-fw', 'padre_id' => null,'orden' => 0
        ]);

        $menu2 = Menu::firstOrCreate([
            'nombre' => 'Dashboard Admin', 'slug' => 'dashboard', 'padre_id' => $menu1->id,
            'orden' => 0
        ]);

        $menu3 = Menu::firstOrCreate([
            'nombre' => 'Dashboard Gerente', 'slug' => 'dashboard-gerente', 'padre_id' => $menu1->id,
            'orden' => 1
        ]);

        $menu4 = Menu::firstOrCreate([
            'nombre' => 'Dashboard Lider-Superior', 'slug' => 'dashboard-lider-super', 'padre_id' => $menu1->id,
            'orden' => 2
        ]);

        $menu5 = Menu::firstOrCreate([
            'nombre' => 'Dashboard Lider', 'slug' => 'dashboard-lider', 'padre_id' => $menu1->id,
            'orden' => 3
        ]);


        $menu6 = Menu::firstOrCreate(['nombre' => 'Sistema','slug' => 'sistema',
                                    'icono' => 'fab fa-windows fa-fw', 'padre_id' => null,'orden' => 1
                                    ])
        ;

        $menu7 = Menu::firstOrCreate(['nombre' => 'Configuraciones','slug' => 'configuracion',
                                    'icono' => 'fas fa-gears fa-fw', 'padre_id' => null,'orden' => 2
        ])
        ;

        $menu8 = Menu::firstOrCreate(['nombre' => 'Empleado','slug' => 'empleado',
                                    'icono' => 'fas fa-users-line fa-fw', 'padre_id' => null,'orden' => 3
        ])
        ;

        $menu9 = Menu::firstOrCreate(['nombre' => 'Préstamo','slug' => 'prestamo',
                'icono' => 'fas fa-money-bill-alt fa-fw', 'padre_id' => null,'orden' => 4
        ])
        ;

        $role1->menus()->sync([
            $menu1->id,$menu2->id,$menu6->id, $menu7->id, $menu8->id, $menu9->id
        ]);

        $role2 = Role::select('id')->where('slug','gerente')->first();

        $role2->menus()->sync([
            $menu1->id,$menu3->id,$menu6->id, $menu7->id, $menu8->id, $menu9->id
        ]);

        $role3 = Role::select('id')->where('slug','lider-superior')->first();

        $role3->menus()->sync([
            $menu1->id,$menu4->id, $menu9->id
        ]);

        $role4 = Role::select('id')->where('slug','lider')->first();

        $role4->menus()->sync([
            $menu1->id,$menu5->id, $menu9->id
        ]);

    }
}

