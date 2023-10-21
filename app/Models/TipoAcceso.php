<?php

namespace App\Models;

use App\Traits\TipoAccesoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoAcceso extends Model
{
    use HasFactory, SoftDeletes;
    use TipoAccesoTrait;

    protected $fillable = [
        'nombre', 'slug', 'es_activo'
    ];

    /**
    * Get all of the roles for the TipoAcceso
    *
    * @return \Illuminate\DatabRolequent\Relations\HasMany
    */
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }
}
