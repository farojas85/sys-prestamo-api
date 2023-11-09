<?php
namespace App\Traits;

use App\Models\User;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait LoginTrait
{
    /**
     * Autenticar
     * @param Request $request
     *
     * @return [type]
     */
    public static function authtenticate(Request $request) {

        $secret = config('auth.auth_secret_key');

        $reglas = [
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];

        $mensajes  = [
            'required' => '* Campo obligatorio',
            'string' => 'Ingrese caracteres alfanuméricos'
        ];

        $validator = Validator::make($request->all(),$reglas,$mensajes);

        if($validator->fails())
        {
            $errors = $validator->errors()->toArray();

            $jwt = JWT::encode($errors,$secret,'HS512');

            return response()->json($jwt,422);
        }

        $credenciales = ['name' => $request->name, 'password' => $request->password, 'es_activo' => 1];

        $user = User::getByName($request->name);

        if($user && Hash::check($request->password,$user->password) && auth()->attempt($credenciales) ) {

            $user->last_login = Carbon::now();
            $user->save();

            $success['token'] = $user->createToken('token-api')->plainTextToken;
            $success['user'] = User::getDataById($user->id);

            $success = JWT::encode($success,env('VITE_SECRET_KEY'),'HS512');

            return response()->json($success,200);
        }

        if(!$user) {
            $errors = array( 'name' => 'Usuario no registrado');
            $jwt = JWT::encode($errors,$secret,'HS512');
            return response()->json($jwt,422);
        }

        if(!Hash::check($request->password,$user->password)) {
            $errors = array( 'password' => 'Contraseña Incorrecta');
            $jwt = JWT::encode($errors,$secret,'HS512');
            return response()->json($jwt,422);
        }

        if(!auth()->attempt($credenciales)) {
            $errors = array( 'name' => 'Usuario Suspendido');
            $jwt = JWT::encode($errors,$secret,'HS512');
            return response()->json($jwt,422);
        }
    }

    public static function logout(Request $request) {
        $user = DB::table('personal_access_tokens')
                ->where('tokenable_id',$request->id)
                ->delete();
        // Auth::user()->tokens->each(function($token,$key){
        //     $token->delete()  ;
        // });

        return response()->json([
            'ok' => 1,
            'mensaje' =>'Sessión cerrada Satisfactoriamiente'
        ], 200);
    }
}
