<?php

namespace App\Models;

use App\Traits\DesembolsoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Desembolso extends Model
{
    use HasFactory, DesembolsoTrait;

    protected $fiilable = [
        'prestamo_id','cliente_cuenta_id','fecha_desembolso', 'fecha_deposito',
        'numero_operacion','imagen_voucher'
    ];

    /**
     * Get the prestamo that owns the Desembolso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo(): BelongsTo
    {
        return $this->belongsTo(Prestamo::class);
    }

    /**
     * Get the cliente_cuenta that owns the Desembolso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente_cuenta(): BelongsTo
    {
        return $this->belongsTo(ClienteCuenta::class);
    }
}
