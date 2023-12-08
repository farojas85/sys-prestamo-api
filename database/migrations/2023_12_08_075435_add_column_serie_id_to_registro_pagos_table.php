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
        Schema::table('registro_pagos', function (Blueprint $table) {
            $table->foreignId('serie_id')->nullable()->after('prestamo_id')
            ->constrained('series','id')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedInteger('numero')->nullable()->after('serie_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registro_pagos', function (Blueprint $table) {
            $table->dropForeign('registro_pagos_serie_id_foreign');
            $table->dropColumn(['serie_id','numero']);
        });
    }
};
