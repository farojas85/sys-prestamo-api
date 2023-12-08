<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * obtener datos de usuario por id
     * @param Request $request
     *
     * @return [type]
     */
    public function mostrarDatosUsuario(Request $request) {
        return User::getDataById($request->id);
    }

    public function cambiarClave(Request $request)
    {
        $secret = config('auth.auth_secret_key');

        $reglas = [
            'password' => [
                'required','string', 'confirmed',
                Password::min(8)->mixedCase()->letters()->numbers()->symbols()
            ],
            'password_confirmation' => [
                'required', 'string',
                Password::min(8)->mixedCase()->letters()->numbers()->symbols()
            ],
        ];

        $mensajes  = [
            'required' => '* Campo obligatorio',
            'string' => 'Ingrese caracteres alfanuméricos',
            'Confirmed' => 'Repite Contraseña debe ser igual a contraseña'
        ];

        $validator = Validator::make($request->all(),$reglas,$mensajes);

        if($validator->fails())
        {
            $errors = $validator->errors()->toArray();

            $jwt = JWT::encode($errors,$secret,'HS512');

            return response()->json($jwt,422);
        }

        $user = User::find($request->user_id);

        $user->password = Hash::make($request->password);
        $user->forzar_cambio_clave = 0;
        $user->save();

        $jwt = JWT::encode([
            'ok' => 1,
            'mensaje' => 'Cambio de contraseña realizado con éxito',
            'data' => $user
        ],$secret,'HS512');

        return response()->json($jwt,200);

    }
}
