<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoConfiguracion extends Model
{
    use HasFactory;

    protected $table = 'tipo_configuraciones';

    protected $fillable = ['nombre'];

    /**
     * Get all of the configuraciones for the TipoConfiguracion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configuraciones(): HasMany
    {
        return $this->hasMany(Configuracion::class);
    }


    public static function getAll()
    {
        return self::select('id','nombre')->with([
            'configuraciones' => function($q) {
                $q->select( 'id','nombre','descripcion','observacion','tipo_configuracion_id')
                    ->with(['configuracion_prestamo' => function($qu) {
                        $qu->select('id','estado','valor','configuracion_id');
                    }]);
            }
        ])->get();
    }
}
