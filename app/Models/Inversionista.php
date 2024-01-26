<?php

namespace App\Models;

use App\Traits\InversionistaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inversionista extends Model
{
    use HasFactory,SoftDeletes, InversionistaTrait;

    protected $fillable = [
        'persona_id', 'user_id', 'es_activo', 'distrito_id',
        'contrato_pdf'
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

    /**
     * Get all of the registro_inversiones for the Inversionista
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registro_inversiones(): HasMany
    {
        return $this->hasMany(Inversionista::class);
    }

}
