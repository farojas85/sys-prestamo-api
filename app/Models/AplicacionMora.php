<?php

namespace App\Models;

use App\Traits\AplicacionMoraTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplicacionMora extends Model
{
    use HasFactory, AplicacionMoraTrait;

    protected $fillable = ['nombre','es_activo'];
}
