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
        Schema::create('registro_inversiones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('inversionista_id')->nullable()->constrained('inversionistas','id')
                ->onDelete('cascade')->onUpdate('cascade')
            ;
            $table->decimal('monto',18,2);
            $table->decimal('tasa_interes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_inversiones');
    }
};
