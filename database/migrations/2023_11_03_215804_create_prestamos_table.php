<?php

use App\Models\AplicacionInteres;
use App\Models\AplicacionMora;
use App\Models\Cliente;
use App\Models\EstadoOperacion;
use App\Models\FrecuenciaPago;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cliente::class)->nullable()
                ->constrained('clientes','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignIdFor(User::class)->nullable()
                ->constrained('users','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->datetime('fecha_prestamo')->index();
            $table->foreignIdFor(FrecuenciaPago::class)->nullable()
                ->constrained('frecuencia_pagos','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignIdFor(AplicacionInteres::class)->nullable()
                    ->constrained('aplicacion_intereses','id')
                    ->onDelete('restrict')->onUpdate('cascade');
            $table->decimal('capital_inicial',18,2);
            $table->decimal('interes',18,2);
            $table->unsignedSmallInteger('numero_cuotas');
            $table->foreignIdFor(AplicacionMora::class)->nullable()
                    ->constrained('aplicacion_moras','id')
                    ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignIdFor(EstadoOperacion::class)->nullable()
                    ->constrained('estado_operaciones','id')
                    ->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
