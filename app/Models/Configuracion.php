<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Configuracion extends Model
{
    use HasFactory;

    protected $table = 'configuraciones';

    protected $fillable = [
        'nombre', 'descripcion', 'observacion'
    ];

    /**
     * Get the tipo_configuracion that owns the Configuracion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_configuracion(): BelongsTo
    {
        return $this->belongsTo(TipoConfiguracion::class);
    }

    /**
     * Get all of the configuracion_prestamos for the Configuracion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configuracion_prestamo(): HasOne
    {
        return $this->hasOne(ConfiguracionPrestamo::class);
    }
}
