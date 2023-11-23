<?php

use App\Models\Cliente;
use App\Models\EntidadFinanciera;
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
        Schema::create('cliente_cuentas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cliente::class)->nullable()
                ->constrained('clientes','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignIdFor(EntidadFinanciera::class)->nullable()
                ->constrained('entidad_financieras','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->string('numero_cuenta')->nullable();
            $table->string('numero_cci')->nullable();
            $table->unsignedTinyInteger('es_activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_cuentas');
    }
};
