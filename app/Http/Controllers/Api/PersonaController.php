<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Persona\TipoDocumentoPersonaRequest;
use App\Models\Persona;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class PersonaController extends Controller
{
    public function buscarDatosDni(TipoDocumentoPersonaRequest $request, $numeroDocumento)
    {
        $request->validated();

        $personaDni = Persona::buscarPersonaDni($numeroDocumento);

        // return $personaDni = Persona::buscarPersonaDni($numeroDocumento);

        // if($personaDni['dni'] =="" || $personaDni['dni'] == null)
        // {
        //     $personaDni = Persona::getDataByNumeroDocumento($numeroDocumento);
        // }

        //$success = JWT::encode(['personaDni'=>$personaDni],env('VITE_SECRET_KEY'),'HS512');
        return response()->json(['personaDni'=>$personaDni],200);
    }
}
