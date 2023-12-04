<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistroPago extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'fecha', 'prestamo_id', 'forma_pago_medio_pago_id', 'total',
        'descuento', 'user_id', 'numero_operacion' ,'fecha_deposito',
        'imagen_voucher', 'estado_operacion_id'
    ];

    /**
     * Get the prestamo that owns the RegistroPago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestamo(): BelongsTo
    {
        return $this->belongsTo(Prestamo::class);
    }

    /**
     * Get the forma_pago_medio_pago that owns the RegistroPago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forma_pago_medio_pago(): BelongsTo
    {
        return $this->belongsTo(FormaPagoMedioPago::class,'forma_pago_medio_pago_id');
    }

    /**
     * Get the estado_operacion that owns the RegistroPago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado_operacion(): BelongsTo
    {
        return $this->belongsTo(EstadoOperacion::class);
    }


    /**
     * Get the user that owns the RegistroPago
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
