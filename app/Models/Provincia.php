<?php

namespace App\Models;

use App\Traits\ProvinciaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provincia extends Model
{
    use HasFactory, ProvinciaTrait;

    protected $fillable = [
        'codigo', 'departamento_id', 'nombre'
    ];

    /**
     * Get the departamento that owns the Provincia
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    /**
     * Get all of the distritos for the Provincia
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function distritos(): HasMany
    {
        return $this->hasMany(Distrito::class);
    }
}
