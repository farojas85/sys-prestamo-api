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
        Schema::table('empleados', function (Blueprint $table) {
            $table->foreignId('superior_id')->nullable()->after('distrito_id')
                    ->constrained('empleados','id')->onDelete('cascade')
                    ->onUpdate('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropForeign('empleados_superior_id_foreign');
            $table->dropColumn('superior_id');
        });
    }
};
