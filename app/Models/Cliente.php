<?php

namespace App\Models;

use App\Traits\ClienteTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes, ClienteTrait;

    protected $fillable = [ 'persona_id' ];

    /**
     * Get the persona that owns the Cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    /**
     * Get all of the prestamos for the Cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class);
    }
}
