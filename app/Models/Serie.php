<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [ 'nombre','es_activo'];

    /**
     * Get all of the registro_pagos for the Serie
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registro_pagos(): HasMany
    {
        return $this->hasMany(RegistroPago::class);
    }
}
