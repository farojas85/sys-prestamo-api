<?php

namespace App\Models;

use App\Traits\FormaPagoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class FormaPago extends Model
{
    use HasFactory, FormaPagoTrait;

    protected $fillable = [
        'nombre', 'es_activo'
    ];

    /**
     * The medio_pagos that belong to the FormaPago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medio_pagos(): BelongsToMany
    {
        return $this->belongsToMany(MedioPago::class)->withTimestamps();
    }
}
