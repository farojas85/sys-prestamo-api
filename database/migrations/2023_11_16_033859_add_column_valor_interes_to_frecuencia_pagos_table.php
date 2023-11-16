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
        Schema::table('frecuencia_pagos', function (Blueprint $table) {
            $table->decimal('valor_interes',18,2)->nullable()->after('dias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('frecuencia_pagos', function (Blueprint $table) {
            $table->dropColumn('valor_interes');
        });
    }
};
