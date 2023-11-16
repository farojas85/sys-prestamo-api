<?php

namespace App\Models;

use App\Traits\FrecuenciaPagoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FrecuenciaPago extends Model
{
    use HasFactory, FrecuenciaPagoTrait;

    protected $fillable = [
        'nombre', 'dias','valor_interes', 'es_activo'
    ];

    /**
     * Get all of the prestamos for the FrecuenciaPago
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamos::class);
    }
}
