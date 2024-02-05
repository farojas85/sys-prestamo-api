<?php
namespace App\Traits;

use App\Http\Requests\Inversion\StoreRegistroInversionRequest;
use App\Models\Inversionista;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait RegistroInversionTrait
{
    /**
     * @param Request $request
     *
     * @return [type]
     */
    public static function getAllPagination(Request $request)
    {
        if($request->role == 'gerente')
        {
            $user = User::where('id',$request->user)->first();

            if($request->user != $user->id)
            {
                return Self::join('inversionistas as inv','inv.id','=','registro_inversiones.inversionista_id')
                        ->join('personas as per','per.id','=','inv.persona_id')
                        ->select(
                            'registro_inversiones.id','registro_inversiones.fecha',
                            'registro_inversiones.monto','registro_inversiones.tasa_interes',
                            DB::Raw("concat(upper(per.apellido_paterno),' ',upper(per.apellido_materno),', ',per.nombres) as inversionista")
                        )
                        ->orderBy('registro_inversiones.created_at','desc')
                        ->where('inv.user_id',$request->user)
                        ->paginate($request->paginacion);
            }

            return Self::join('inversionistas as inv','inv.id','=','registro_inversiones.inversionista_id')
                ->join('personas as per','per.id','=','inv.persona_id')
                ->select(
                    'registro_inversiones.id','registro_inversiones.fecha',
                    'registro_inversiones.monto','registro_inversiones.tasa_interes',
                    DB::Raw("concat(upper(per.apellido_paterno),' ',upper(per.apellido_materno),', ',per.nombres) as inversionista")
                )
                ->orderBy('registro_inversiones.created_at','desc')
                ->paginate($request->paginacion);
        }
        return Self::join('inversionistas as inv','inv.id','=','registro_inversiones.inversionista_id')
                ->select('registro_inversiones.id','registro_inversiones.fecha','registro_inversiones.monto','registro_inversiones.tasa_interes')
                ->orderBy('registro_inversiones.created_at','desc')
                ->where('inv.user_id',$request->user)
                ->paginate($request->paginacion);
    }

    /**
     * @param StoreRegistroInversionRequest $request
     *
     * @return array
     */
    public static function saveData(StoreRegistroInversionRequest $request): array
    {
        try {
            $inversionista = Inversionista::select('id','persona_id','user_id')->where('user_id', $request->user_id)->first();

            $registro_inversion = self::create([
                'fecha' => Carbon::now(),
                'inversionista_id' => $inversionista->id,
                'monto' => $request->monto,
                'tasa_interes' => $request->tasa_interes
            ]);

            return [
                'ok' => 1,
                'mensaje' => 'Monto de inversión registrado satisfactoriamente',
                'data' => $registro_inversion
            ];
        } catch (Exception $th) {
            return [
                'ok' => 0,
                'mensaje' =>'Code: '.$th->getCode()." mensaje: ".$th->getMessage(),
                'data' => null
            ];
        }
    }
}
