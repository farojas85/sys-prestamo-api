<?php
namespace App\Traits;

use App\Models\Persona;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait ProvinciaTrait
{
    public static function getList()
    {
        return self::select('id','nombre')->orderBy('codigo','asc')->get();
    }

    public static function getbyDepartamentoId(int $departamento_id)
    {
        return self::select('id','nombre')->where('departamento_id', $departamento_id)->orderBy('codigo','asc')->get();
    }
}
