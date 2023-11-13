<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            SexoSeeder::class,
            TipoDocumentoSeeder::class,
            TipoAccesoSeeder::class,
            RoleSeeder::class,
            MenuSeeder::class,
            PermisoSeeder::class,
            EmpleadoSeeder::class,
            FrecuenciaPagoSeeder::class,
            AplicacionInteresSeeder::class,
            AplicacionMoraSeeder::class,
            MonedaSeeder::class,
            TipoConfiguracionSeeder::class,
            ConfiguracionSeeder::class,
            ConfiguracionPrestamoSeeder::class,
            ConfiguracionEmpresaSeeder::class,
            EstadoOperacionSeeder::class,
            EstadoHistorialSeeder::class,
            UbigeoSeeder::class,
        ]);
    }
}
