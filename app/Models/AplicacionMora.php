<?php

namespace App\Models;

use App\Traits\AplicacionMoraTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AplicacionMora extends Model
{
    use HasFactory, AplicacionMoraTrait;

    protected $fillable = ['nombre','es_activo'];

    /**
     * Get all of the prestamos for the AplicacionMora
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class);
    }
}
