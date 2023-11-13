<?php

namespace App\Models;

use App\Traits\DepartamentoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    use HasFactory, DepartamentoTrait;

    protected $fillable = [
        'codigo', 'nombre'
    ];

    /**
     * Get all of the provincias for the Departamento
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function provincias(): HasMany
    {
        return $this->hasMany(Provincia::class);
    }
}
