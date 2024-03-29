<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasPermisosTrait;
use App\Traits\HasMenusTrait;
use App\Traits\HasRolesTrait;
use App\Traits\LoginTrait;
use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use HasRolesTrait, HasMenusTrait, HasPermisosTrait;
    use LoginTrait, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'foto', 'es_activo',
        'last_login','last_ip', 'forza_cambio_clave'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the empleado associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empleado(): HasOne
    {
        return $this->hasOne(Empleado::class);
    }

    /**
     * The roles that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Get all of the user for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all of the registro_pagos for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registro_pagos(): HasMany
    {
        return $this->hasMany(RegistroPago::class);
    }

    /**
     * Get the inversionista associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inversionista(): HasOne
    {
        return $this->hasOne(Inversionista::class);
    }

}
