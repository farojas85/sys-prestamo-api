<?php
namespace App\Traits;

use App\Models\Persona;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait DepartamentoTrait
{
    public static function getList()
    {
        return self::select('id','nombre')->orderBy('codigo','asc')->get();
    }
}
