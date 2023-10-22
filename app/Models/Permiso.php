<?php

namespace App\Models;

use App\Traits\PermisoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permiso extends Model
{
    use HasFactory, SoftDeletes, PermisoTrait;

    protected $fillable = [
        'nombre', 'slug', 'es_activo', 'deleted_at'
    ];

    /**
     * The roles that belong to the Permiso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
