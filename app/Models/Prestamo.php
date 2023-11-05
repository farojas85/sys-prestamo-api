<?php

namespace App\Models;

use App\Traits\PrestamoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestamo extends Model
{
    use HasFactory, SoftDeletes, PrestamoTrait;

    protected $fillable = [
        'cliente_id', 'user_id', 'fecha_prestamo', 'frecuencia_pago_id', 'aplicacion_interes_id',
        'capital_inicial', 'interes', 'numero_cuotas', 'aplicacion_mora_id',
        'estado_operacion_id', 'deleted_at'
    ];

    /**
     * Get the cliente that owns the Prestamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Get the user that owns the Prestamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the frecuencia_pago that owns the Prestamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function frecuencia_pago(): BelongsTo
    {
        return $this->belongsTo(FrecuenciaPago::class);
    }

    /**
     * Get the aplicacion_interes that owns the Prestamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aplicacion_interes(): BelongsTo
    {
        return $this->belongsTo(AplicacionInteres::class);
    }

    /**
     * Get the aplicacion_mora that owns the Prestamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aplicacion_mora(): BelongsTo
    {
        return $this->belongsTo(AplicacionMora::class);
    }

    /**
     * Get the estado_operacion that owns the Prestamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado_operacion(): BelongsTo
    {
        return $this->belongsTo(EstadoOperacion::class);
    }

    /**
     * Get all of the historial_tramites for the Prestamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historial_tramites(): HasMany
    {
        return $this->hasMany(HistorialTramite::class);
    }
}
