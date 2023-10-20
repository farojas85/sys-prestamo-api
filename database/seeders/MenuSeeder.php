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

        $menu1 = Menu::firstOrCreate(['nombre' => 'Dashboard','slug' => 'principal',
                                    'icono' => 'fas fa-tachometer-alt fa-fw', 'padre_id' => null,'orden' => 0
                                    ]);

        $menu2 = Menu::firstOrCreate(['nombre' => 'Sistema','slug' => 'sistema',
                                    'icono' => 'fab fa-windows fa-fw', 'padre_id' => null,'orden' => 1
                                    ])
        ;

        $menu3 = Menu::firstOrCreate(['nombre' => 'Configuraciones','slug' => 'configuracion',
                                    'icono' => 'fas fa-gears fa-fw', 'padre_id' => null,'orden' => 2
        ])
        ;

        $menu3 = Menu::firstOrCreate(['nombre' => 'Personal','slug' => 'personal',
                                    'icono' => 'fas fa-users-line fa-fw', 'padre_id' => null,'orden' => 3
        ])
        ;

        $menu4 = Menu::firstOrCreate(['nombre' => 'Préstamo','slug' => 'prestamo',
                'icono' => 'fas fa-money-bill-alt fa-fw', 'padre_id' => null,'orden' => 4
        ])
        ;


        $role1->menus()->sync([$menu1->id,$menu2->id,$menu3->id,$menu4->id]);
    }
}
