<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cuota extends Model
{
    use HasFactory;

    protected $fillable = [
        'prestamo_id', 'numero_cuota', 'descripcion', 'monto_cuota',
        'fecha_vencimiento', 'estado_operacion_id'
    ];

    /**
     * Get the prestamo that owns the Cuota
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo(): BelongsTo
    {
        return $this->belongsTo(Prestamo::class, 'prestamo_id', 'id');
    }

    /**
     * Get the estado_operacion that owns the Cuota
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado_operacion(): BelongsTo
    {
        return $this->belongsTo(EstadoOperacion::class, 'estado_operacion_id', 'id');
    }
}
