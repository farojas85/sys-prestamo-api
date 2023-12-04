<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstadoOperacion extends Model
{
    use HasFactory;

    protected $table = "estado_operaciones";

    protected $fillable = [ 'nombre', 'clase' ];

    /**
     * Get all of the prestamos for the EstadoOperacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class);
    }

    /**
     * Get all of the cuotas for the EstadoOperacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cuotas(): HasMany
    {
        return $this->hasMany(Cuota::class);
    }

    /**
     * Get all of the registro_pagos for the EstadoOperacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registro_pagos(): HasMany
    {
        return $this->hasMany(RegistroPago::class);
    }
}
