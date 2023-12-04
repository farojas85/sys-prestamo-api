<?php

namespace App\Models;

use App\Traits\MedioPagoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MedioPago extends Model
{
    use HasFactory, MedioPagoTrait;

    protected $fillable = [
        'nombre','es_activo'
    ];

    /**
     * The forma_pagos that belong to the MedioPago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function forma_pagos(): BelongsToMany
    {
        return $this->belongsToMany(FormaPago::class);
    }
}
