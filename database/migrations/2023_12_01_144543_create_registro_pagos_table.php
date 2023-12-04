<?php

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
        Schema::create('registro_pagos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('prestamo_id')->nullable()->constrained('prestamos','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('forma_pago_medio_pago_id')->nullable()->constrained('forma_pago_medio_pago','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->decimal('total',18,2)->nullable();
            $table->decimal('descuento',18,2)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->string('numero_operacion')->nullable();
            $table->date('fecha_deposito')->nullable();
            $table->string('imagen_voucher')->nullable();
            $table->foreignId('estado_operacion_id')->nullable()->constrained('estado_operaciones','id')
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
        Schema::dropIfExists('registro_pagos');
    }
};
