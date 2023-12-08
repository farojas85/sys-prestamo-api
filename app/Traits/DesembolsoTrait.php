<?php
namespace App\Traits;

use App\Http\Requests\Desembolso\StoreDesembolsoRequest;
use App\Models\Cliente;
use App\Models\ClienteCuenta;
use App\Models\EstadoOperacion;
use App\Models\Persona;
use App\Models\Prestamo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait DesembolsoTrait
{
    /**
     * @param StoreDesembolsoRequest $request
     *
     * @return [type]
     */
    public static function saveData(StoreDesembolsoRequest $request)
    {
        DB::beginTransaction();
        try {

            //Guardamos el desembolso
            $desembolso  = new Self();
            $desembolso->prestamo_id = $request->prestamo_id;
            $desembolso->cliente_cuenta_id = $request->cliente_cuenta_id;
            $desembolso->fecha_desembolso = $request->fecha_desembolso;
            $desembolso->numero_operacion = $request->numero_operacion;
            $desembolso->save();

            //Guardamos la imagen del Voucher
            $cliente_cuenta = ClienteCuenta::select('id','cliente_id')->where('id',$request->cliente_cuenta_id)->first();
            $cliente = Cliente::select('id','persona_id')->where('id',$cliente_cuenta->cliente_id)->first();
            $persona_dni = Persona::where('id',$cliente->persona_id)->first()->numero_documento;

            $file = $request->file('imagen_voucher');
            $nombre_archivo = "VOUCHER_DESEMBOLSO_".$request->prestamo_id."_".date('Ymd').".".$file->extension();

            Storage::disk('clientes')->put($persona_dni."/prestamos"."/".$request->prestamo_id."/".$nombre_archivo,File::get($file));

            //Actualizamos el nombre del archivo del voucher en el desembolso
            $desembolso->imagen_voucher = $nombre_archivo;
            $desembolso->save();

            //Actualizamos el estado ABONADO al préstamo
            $prestamo = Prestamo::find($request->prestamo_id);
            $estado_operacion = EstadoOperacion::select('id')->where('nombre','Abonado')->first();
            $prestamo->estado_operacion_id = $estado_operacion->id;
            $prestamo->save();

            DB::commit();

            return [
                'ok' => 1,
                'mensaje' => 'El Desembolso ha sido registrado de manera satisfactoria ',
                'data' => $nombre_archivo
            ];

        } catch (Exception $ex) {
            DB::rollBack();
            return [
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            ];
        }
    }
}
