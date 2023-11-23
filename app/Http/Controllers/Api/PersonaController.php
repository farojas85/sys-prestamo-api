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
    public function buscarDatosDni(Request $request)
    {
        // $validar = Validator::make(
        //     $request->all(),
        //     [ 'numero_documento' => 'required' ],
        //     [ 'required' => '* Campo obligatorio' ]
        // );

        // if($validar->fails())
        // {
        //     return response()->json($validar->errors(),422);
        // }

        $personaDni = Persona::buscarPersonaDni($request->numero_documento);

        // return $personaDni = Persona::buscarPersonaDni($numeroDocumento);

        // if($personaDni['dni'] =="" || $personaDni['dni'] == null)
        // {
        //     $personaDni = Persona::getDataByNumeroDocumento($numeroDocumento);
        // }

        $success = JWT::encode(['personaDni'=> $personaDni],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }

    public function buscarPersonaExiste(Request $request)
    {
        $personaDni = Persona::getDataByNumeroDocumento($request->numero_documento);

        $success = JWT::encode(['personaDni'=>$personaDni],env('VITE_SECRET_KEY'),'HS512');
        return response()->json($success,200);
    }
}
