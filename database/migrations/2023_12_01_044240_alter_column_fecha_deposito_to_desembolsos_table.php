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
        Schema::table('desembolsos', function (Blueprint $table) {
            $table->date('fecha_deposito')->nullable()->change();
            $table->string('imagen_voucher')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('desembolsos', function (Blueprint $table) {
            $table->date('fecha_deposito')->change();
            $table->string('imagen_voucher')->change();
        });
    }
};
