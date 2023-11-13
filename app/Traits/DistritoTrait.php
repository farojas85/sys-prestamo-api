<?php
namespace App\Traits;

use App\Models\Persona;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait DistritoTrait
{
    public static function getList()
    {
        return self::select('id','nombre')->orderBy('codigo','asc')->get();
    }

    public static function getbyProvinciaId(int $provincia_id)
    {
        return self::select('id','nombre')->where('provincia_id', $provincia_id)->orderBy('codigo','asc')->get();
    }
}
