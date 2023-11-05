<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoHistorial extends Model
{
    use HasFactory;

    protected $table = 'estado_historiales';

    protected $fillable = ['nombre','clase'];
}
