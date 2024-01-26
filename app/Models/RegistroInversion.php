<?php

namespace App\Models;

use App\Traits\RegistroInversionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistroInversion extends Model
{
    use HasFactory, RegistroInversionTrait;

    protected $table  ='registro_inversiones';

    protected $fillable = [
        'inversionista_id', 'fecha', 'monto', 'tasa_interes'
    ];

    /**
     * Get the inversionista that owns the RegistroInversion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inversionista(): BelongsTo
    {
        return $this->belongsTo(Inversionista::class);
    }
}
