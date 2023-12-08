<?php

namespace App\Models;

use App\Http\Traits\HasPermisosTrait;
use App\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes, RoleTrait;

    protected $fillable = [
        'nombre', 'slug', 'tipo_acceso_id', 'es_activo'
    ];

    /**
    * Get the tipoo_acceso that owns the Role
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function tipo_acceso(): BelongsTo
    {
        return $this->belongsTo(TipoAcceso::class);
    }

    /**
     * The users that belong to the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

     /**
     * The menus that belong to the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class)->withTimestamps();
    }

    /**
     * The permisos that belong to the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permisos(): BelongsToMany
    {
        return $this->belongsToMany(Permiso::class)->withTimestamps();
    }

    /**
     * Get all of the notificaciones for the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notificaciones(): HasMany
    {
        return $this->hasMany(Notificacion::class);
    }
}
