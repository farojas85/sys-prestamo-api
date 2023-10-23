<?php

namespace App\Models;

use App\Traits\MonedaTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use HasFactory, MonedaTrait;

    protected $fillable = [
        'codigo','nombre','pais','simbolo'
    ];
}
