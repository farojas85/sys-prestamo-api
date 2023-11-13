<?php

use App\Models\EstadoOperacion;
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
        Schema::create('cuotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestamo_id')->nullable()
                    ->constrained('prestamos','id')->onDelete('cascade')
                    ->onUpdate('cascade')
            ;
            $table->string('descripcion');
            $table->date('fecha_vencimiento');
            $table->foreignIdFor(EstadoOperacion::class)->nullable()
                    ->constrained('estado_operaciones','id')
                    ->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuotas');
    }
};
