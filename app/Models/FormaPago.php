<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FormaPago extends Model
{
    use HasFactory;

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
