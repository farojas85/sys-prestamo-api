<?php

namespace App\Models;

use App\Traits\AplicacionInteresTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AplicacionInteres extends Model
{
    use HasFactory, AplicacionInteresTrait;

    protected $table = "aplicacion_intereses";

    protected $fillable = ['nombre','es_activo'];

    /**
     * Get all of the prestamos for the AplicacionInteres
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class);
    }
}
