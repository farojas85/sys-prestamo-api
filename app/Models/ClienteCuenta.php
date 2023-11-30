<?php

namespace App\Models;

use App\Traits\ClienteCuentaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClienteCuenta extends Model
{
    use HasFactory, ClienteCuentaTrait;

    protected $fillable = [
        'cliente_id', 'entidad_financiera_id', 'numero_cuenta', 'numero_cci'
    ];

    /**
     * Get the cliente that owns the ClienteCuenta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Get the entidad_financiera that owns the ClienteCuenta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entidad_financiera(): BelongsTo
    {
        return $this->belongsTo(EntidadFinanciera::class);
    }
}
