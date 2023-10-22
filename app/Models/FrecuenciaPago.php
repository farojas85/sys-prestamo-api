<?php

namespace App\Models;

use App\Traits\FrecuenciaPagoTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrecuenciaPago extends Model
{
    use HasFactory, FrecuenciaPagoTrait;

    protected $fillable = [
        'nombre', 'dias'
    ];
}
