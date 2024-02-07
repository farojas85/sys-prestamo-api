<?php
namespace App\Traits;

use App\Http\Requests\Inversion\StoreRegistroInversionRequest;
use App\Http\Requests\Inversion\UpdateRegistroInversionRequest;
use App\Models\Inversionista;
use App\Models\RegistroInversion;
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
        if(in_array($request->role,['gerente','super-usuario']) )
        {
            return Self::join('inversionistas as inv','inv.id','=','registro_inversiones.inversionista_id')
                    ->join('personas as per','per.id','=','inv.persona_id')
                    ->select(
                        'registro_inversiones.id','registro_inversiones.fecha',
                        'registro_inversiones.monto','registro_inversiones.tasa_interes',
                        DB::Raw("concat(upper(per.apellido_paterno),' ',upper(per.apellido_materno),', ',per.nombres) as inversionista"),
                        DB::Raw("
                            (registro_inversiones.fecha - CURRENT_DATE)*-1 as dias_transcurridos
                        "),
                        DB::Raw("
                            CASE
                                WHEN (registro_inversiones.fecha - CURRENT_DATE)*-1 = 0 THEN
                                    ROUND(registro_inversiones.monto,2)*0
                                WHEN (registro_inversiones.fecha - CURRENT_DATE)*-1 > 0 THEN
                                    ROUND(registro_inversiones.monto*ROUND((registro_inversiones.tasa_interes/30)/100,4)*((registro_inversiones.fecha - CURRENT_DATE)*-1),2)
                            END as rentabilidad_diaria
                        ")
                    )
                    ->orderBy('registro_inversiones.created_at','desc')
                    ->where('inv.id','like',$request->user)
                    ->paginate($request->paginacion);
        }

        return Self::join('inversionistas as inv','inv.id','=','registro_inversiones.inversionista_id')
                ->select(
                    'registro_inversiones.id','registro_inversiones.fecha','registro_inversiones.monto',
                    'registro_inversiones.tasa_interes',
                    DB::Raw("
                        (registro_inversiones.fecha - CURRENT_DATE)*-1 as dias_transcurridos
                    "),
                    DB::Raw("
                        CASE
                            WHEN (registro_inversiones.fecha - CURRENT_DATE)*-1 = 0 THEN
                                ROUND(registro_inversiones.monto,2)*0
                            WHEN (registro_inversiones.fecha - CURRENT_DATE)*-1 > 0 THEN
                                ROUND(registro_inversiones.monto*ROUND((registro_inversiones.tasa_interes/30)/100,4)*((registro_inversiones.fecha - CURRENT_DATE)*-1),2)
                        END as rentabilidad_diaria
                    ")
                )
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
            $registro_inversion = self::create([
                'fecha' => Carbon::now(),
                'inversionista_id' => $request->inversionista_id,
                'monto' => $request->monto,
                'tasa_interes' => $request->tasa_interes
            ]);

            return [
                'ok' => 1,
                'mensaje' => 'El registro de inversión fue añadido satisfactoriamente',
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

    public static function getData(Request $request)
    {
        return RegistroInversion::find($request->id);
    }

    /**
     * @param StoreRegistroInversionRequest $request
     *
     * @return array
     */
    public static function updateData(UpdateRegistroInversionRequest $request): array
    {
        try {
            $registro_inversion = self::where('id', $request->id)->update([
                'fecha' => $request->fecha,
                'inversionista_id' => $request->inversionista_id,
                'monto' => $request->monto,
                'tasa_interes' => $request->tasa_interes
            ]);

            return [
                'ok' => 1,
                'mensaje' => 'El registro de inversión fue modificado satisfactoriamente',
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

    /**
     * @param Request $request
     *
     * @return array
     */
    public static function deleteData(Request $request): array
    {
        try {
            $registro_inversion = self::find($request->id);

            $registro_inversion->forceDelete();

            return array(
                'ok' => 1,
                'mensaje' => "El registro de inversión ha sido eliminado satisfactoriamente",
                'data' => $registro_inversion
            );
        }
        catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public static function getDataDashboard(Request $request): array
    {
        $inversionista = Inversionista::select('id')->where('user_id',$request->user)->first();

        $total_inversiones = RegistroInversion::leftJoin('retiro_inversiones as riv','riv.inversionista_id','=','registro_inversiones.inversionista_id')
                            ->where('registro_inversiones.inversionista_id',$inversionista->id)
                            ->select(DB::Raw("(sum(registro_inversiones.monto) - COALESCE(sum(riv.monto),0)) as total_inversiones"))
                            ->first()
        ;

        $ganancia_inversion = RegistroInversion::leftJoin('retiro_inversiones as riv','riv.inversionista_id','=','registro_inversiones.inversionista_id')
                                ->where('registro_inversiones.inversionista_id',$inversionista->id)
                                ->select(
                                    DB::Raw("
                                        SUM(CASE
                                            WHEN (registro_inversiones.fecha - CURRENT_DATE)*-1 = 0 THEN
                                                ROUND(registro_inversiones.monto,2)*0
                                            WHEN (registro_inversiones.fecha - CURRENT_DATE)*-1 > 0 THEN
                                                ROUND((registro_inversiones.monto - COALESCE(riv.monto,0))*ROUND((registro_inversiones.tasa_interes/30)/100,4)*((registro_inversiones.fecha - CURRENT_DATE)*-1),2)
                                        END) as total_rentabilidad
                                    ")
                                )
                                ->first()
        ;

        return [
            'total_inversiones' => $total_inversiones->total_inversiones,
            'total_ganancia' => $ganancia_inversion->total_rentabilidad
        ];
    }
}
