<?php

namespace App\Models;

use App\Traits\EmpleadoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory, SoftDeletes, EmpleadoTrait;

    protected $fillable = [
        'persona_id', 'user_id', 'es_activo', 'distrito_id'
    ];

    /**
     * Get the persona that owns the Empleado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }

    /**
     * Get the user that owns the Empleado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the distrito that owns the Empleado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distrito(): BelongsTo
    {
        return $this->belongsTo(Distrito::class);
    }
}
