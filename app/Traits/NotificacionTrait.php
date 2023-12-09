<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Notificacion\StoreNotificacionRequest;
use App\Models\Notificacion;
use App\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait NotificacionTrait
{
    /**
     * @param Request $request
     *
     * @return [type]
     */
    public static function getAllPagination(Request $request)
    {
        $buscar = mb_strtoupper($request->buscar);

        return Self::leftJoin('roles as ro','ro.id','=','notificaciones.role_id')
            ->select(
            'notificaciones.id','titulo','contenido','ro.nombre as role','ro.slug as role_slug',
            DB::Raw("date_format(fecha_inicio,'%d/%m/%Y') as fecha_inicio"),
            DB::Raw("date_format(fecha_fin,'%d/%m/%Y') as fecha_fin")
        )
        ->latest('notificaciones.created_at')
        ->paginate($request->paginacion);
    }

    /**
     * @param StoreNotificacionRequest $request
     *
     * @return array
     */
    public static function saveData(StoreNotificacionRequest $request): array
    {
        try {
            //GUARDAMOS LA NOTIFICACIÓN
            $notificacion = new Self();
            $notificacion->titulo = $request->titulo;
            $notificacion->contenido = $request->contenido;
            $notificacion->fecha_inicio  = $request->fecha_inicio;
            $notificacion->fecha_fin  = $request->fecha_fin;
            $notificacion->role_id  = $request->role_id;
            $notificacion->save();


            //GUARDAMOS LA IMAGEN
            if($request->file('imagen'))
            {
                $file = $request->file('imagen');
                $nombre_archivo = "NOTIFICACION_".$notificacion->id.".".$file->extension();

                Storage::disk('notificaciones')->put($nombre_archivo,File::get($file));

                $notificacion->imagen = $nombre_archivo;
                $notificacion->save();
            }

            return [
                'ok' => 1,
                'mensaje' => 'La notificacion fue registrado satisdactoriamente',
                'data' => $notificacion
            ];

        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

    /**
     * @param StoreNotificacionRequest $request
     *
     * @return array
     */
    public static function updateData(StoreNotificacionRequest $request): array
    {
        try {
            //GUARDAMOS LA NOTIFICACIÓN
            $notificacion = Self::where('id',$request->id)->first();

            $notificacion->titulo = $request->titulo;
            $notificacion->contenido = $request->contenido;
            $notificacion->fecha_inicio  = $request->fecha_inicio;
            $notificacion->fecha_fin  = $request->fecha_fin;
            $notificacion->role_id  = $request->role_id;
            $notificacion->save();


            //GUARDAMOS LA IMAGEN
            if($request->file('imagen'))
            {
                $file = $request->file('imagen');
                $nombre_archivo = "NOTIFICACION_".$notificacion->id.".".$file->extension();

                Storage::disk('notificaciones')->put($nombre_archivo,File::get($file));

                $notificacion->imagen = $nombre_archivo;
                $notificacion->save();
            }

            return [
                'ok' => 1,
                'mensaje' => 'La notificacion fue modificada satisdactoriamente',
                'data' => $notificacion
            ];

        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

    public static function deleteRecord(Request $request)
    {
        try {
            $notificacion = Self::where('id',$request->id)->first();
            $notificacion->delete();
            return [
                'ok' => 1,
                'mensaje' => 'La notificacion fue eliminada satisdactoriamente',
                'data' => $notificacion
            ];
        } catch (Exception $ex) {
            return array(
                'ok' => $ex->getCode(),
                'mensaje' => $ex->getMessage(),
                'data' => null
            );
        }
    }

    public static function getNotificacionActiva(Request $request)
    {
        $fecha_hoy = date('Y-m-d');

        $role = Role::select('id')->where('slug',$request->role)->first();

        return $notificacion = Self::select('id','imagen')
                ->where('role_id',$role->id)
                ->first();
    }
}
