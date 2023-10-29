<?php

namespace App\Models;

use App\Traits\SexoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sexo extends Model
{
    use HasFactory, SexoTrait;

    protected $fillable = [
        'codigo', 'nombre'
    ];

    /**
    * Get all of the personas for the Sexo
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class);
    }
}
