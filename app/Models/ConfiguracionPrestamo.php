<?php

namespace App\Models;

use App\Traits\ConfiguracionPrestamoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConfiguracionPrestamo extends Model
{
    use HasFactory, ConfiguracionPrestamoTrait;

    protected $fillable = [
        'configuracion_id', 'estado', 'valor'
    ];

    /**
     * Get the configuracion that owns the ConfiguracionPrestamo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function configuracion(): BelongsTo
    {
        return $this->belongsTo(Configuracion::class);
    }
}
