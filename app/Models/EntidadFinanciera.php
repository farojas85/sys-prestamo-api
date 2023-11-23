<?php

namespace App\Models;

use App\Traits\EntidadFinancieraTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EntidadFinanciera extends Model
{
    use HasFactory, EntidadFinancieraTrait;

    protected $fillable = [
        'codigo', 'nombre', 'es_activo'
    ];

    /**
     * Get all of the cliente_cuentas for the EntidadFinanciera
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cliente_cuentas(): HasMany
    {
        return $this->hasMany(ClienteCuenta::class);
    }
}
