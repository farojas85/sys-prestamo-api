<?php

namespace App\Models;

use App\Traits\DistritoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Distrito extends Model
{
    use HasFactory, DistritoTrait;

    protected $fillable = [
        'codigo', 'provincia_id', 'nombre'
    ];

    /**
     * Get the provincia that owns the Distrito
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class,'provincia_id','id');
    }
    /**
     * Get all of the comments for the Distrito
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientes(): HasMany
    {
        return $this->hasMany(Cliente::class);
    }

    /**
     * Get all of the empleados for the Distrito
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empleados(): HasMany
    {
        return $this->hasMany(Empleado::class);
    }

}
