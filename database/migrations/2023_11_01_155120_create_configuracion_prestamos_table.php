<?php

use App\Models\Configuracion;
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
        Schema::create('configuracion_prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Configuracion::class)->nullable()
                ->constrained('configuraciones','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedTinyInteger('estado')->nullable();
            $table->unsignedFloat('valor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion_prestamos');
    }
};
