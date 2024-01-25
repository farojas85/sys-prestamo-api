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
        Schema::create('inversionistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persona_id')->nullable()->constrained('personas','id')
                ->onDelete('cascade')->onUpdate('cascade')
            ;
            $table->foreignId('user_id')->nullable()->constrained('users','id')
                ->onDelete('cascade')->onUpdate('cascade')
            ;
            $table->foreignId('distrito_id')->nullable()
                    ->constrained('distritos','id')->onDelete('cascade')
                    ->onUpdate('cascade')
            ;
            $table->string('contrato_pdf',255)->nullable();
            $table->unsignedTinyInteger('es_activo')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inversionistas');
    }
};
