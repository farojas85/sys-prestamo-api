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
        Schema::create('desembolsos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestamo_id')->nullable()->constrained('prestamos','id')
                ->onDelete('restrict')->onUpdate('cascade')
            ;
            $table->foreignId('cliente_cuenta_id')->nullable()->constrained('cliente_cuentas','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->date('fecha_desembolso');
            $table->string('numero_operacion');
            $table->date('fecha_deposito');
            $table->string('imagen_voucher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desembolsos');
    }
};
