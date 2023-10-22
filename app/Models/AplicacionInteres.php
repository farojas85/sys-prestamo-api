<?php

namespace App\Models;

use App\Traits\AplicacionInteresTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplicacionInteres extends Model
{
    use HasFactory, AplicacionInteresTrait;

    protected $table = "aplicacion_intereses";

    protected $fillable = ['nombre','es_activo'];
}
