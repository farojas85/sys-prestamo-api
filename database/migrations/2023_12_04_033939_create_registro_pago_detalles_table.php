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
        Schema::create('registro_pago_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registro_pago_id')->nullable()->constrained('registro_pagos')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('cuota_id')->nullable()->constrained('cuotas')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('monto_pagar',18,2);
            $table->decimal('monto_pagado',18,2);
            $table->decimal('saldo',18,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_pago_detalles');
    }
};
