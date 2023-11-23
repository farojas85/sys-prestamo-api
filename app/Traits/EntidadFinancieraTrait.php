<?php
namespace App\Traits;

use App\Models\EntidadFinanciera;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait EntidadFinancieraTrait
{
    public static function getList() {
        return Self::select('id','codigo','nombre')->where('es_activo',1)->get();
    }
}
