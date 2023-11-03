<?php

namespace App\Models;

use App\Traits\ConfiguracionEmpresaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConfiguracionEmpresa extends Model
{
    use HasFactory, ConfiguracionEmpresaTrait;

    protected $fillable = [
        'nombre', 'direccion', 'telefono', 'correo_corporativo',
        'moneda_id'
    ];

    /**
     * Get the moneda that owns the ConfiguracionEmpresa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function moneda(): BelongsTo
    {
        return $this->belongsTo(Moneda::class);
    }

}
