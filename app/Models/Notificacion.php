<?php

namespace App\Models;

use App\Traits\NotificacionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notificacion extends Model
{
    use HasFactory, NotificacionTrait;

    protected $table = "notificaciones";

    protected $fillable  = [
        'titulo', 'contenido', 'imagen',
        'fecha_inicio', 'fecha_fin', 'role_id'
    ];

    /**
     * Get the role that owns the Notificacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
