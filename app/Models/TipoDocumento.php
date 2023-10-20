<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo', 'nombre_corto', 'nombre_largo', 'longitud', 'es_activo'
    ];

    /**
    * Get all of the personas for the TipoDocumento
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function personas(): HasMany
    {
        return $this->hasMany(Persona::class);
    }
}
