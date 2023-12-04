<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FormaPagoMedioPago extends Pivot
{
    protected $primaryKey = 'id';

    protected $table = 'forma_pago_medio_pago';

    /**
     * Get the forma_pago that owns the FormaPagoMedioPago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forma_pago(): BelongsTo
    {
        return $this->belongsTo(FormaPago::class,'forma_pago_id');
    }

    /**
     * Get the medio_pago that owns the FormaPagoMedioPago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medio_pago(): BelongsTo
    {
        return $this->belongsTo(MedioPago::class,'medio_pago_id');
    }

    /**
     * Get all of the registro_pagos for the FormaPagoMedioPago
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registro_pagos(): HasMany
    {
        return $this->hasMany(RegistroPago::class);
    }
}
