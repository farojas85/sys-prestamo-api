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
        Schema::table('clientes', function (Blueprint $table) {
            $table->foreignId('distrito_id')->nullable()->after('es_activo')
                    ->constrained('distritos','id')->onDelete('cascade')
                    ->onUpdate('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropForeign('clientes_distrito_id_foreign');
            $table->dropColumn('distrito_id');
        });
    }
};
