<?php

use App\Models\EstadoHistorial;
use App\Models\Prestamo;
use App\Models\User;
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
        Schema::create('historial_tramites', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora');
            $table->foreignIdFor(Prestamo::class)->nullable()->constrained('prestamos','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('user_origen')->nullable()->constrained('users','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('user_destino')->nullable()->constrained('users','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->text('observaciones',500)->nullable();
            $table->foreignIdFor(EstadoHistorial::class)->nullable()->constrained('estado_historiales','id')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_tramites');
    }
};
