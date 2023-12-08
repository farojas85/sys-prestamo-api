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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('contenido')->nullable();
            $table->string('imagen')->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->foreignId('role_id')->nullable()->constrained('roles','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedTinyInteger('es_activo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};
