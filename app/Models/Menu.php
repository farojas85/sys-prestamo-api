<?php

namespace App\Models;

use App\Traits\MenuTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes, MenuTrait;

    protected $fillable =[
        'id','nombre','slug','icono','padre_id','orden','es_activo'
    ];

    /**
     * The roles that belong to the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Get the padre that owns the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function padre(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'padre_id', 'id');
    }

    /**
     * Get all of the menus for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class,'padre_id','id');
    }

    /**
     * getMenus Padres
     * @param mixed $front
     *
     * @return [type]
     */
    public function menusPadres($user_id,$front){
        //Obtenemos el Id del Rol del usuario Autenticado
        $roles = User::find($user_id)->roles()
                    ->select('roles.id','roles.nombre','roles.slug')->first()
        ;

        if($front) {
            return Menu::whereHas('roles', function ($query) use($roles) {
                $query->where('role_id',$roles->id)->orderby('padre_id');
            })->where('es_activo',1)->whereNull('padre_id')->orderby('orden')->get()->toArray();
        } else {
            return Menu::orderby('padre_id')->orderby('orden')->get()->toArray();
        }
    }

    /**
     * get menus hijos
     * @param mixed $padres
     *
     * @return [type]
     */
    public function menusHijos($user_id,$padres)
    {
        $roles = User::find($user_id)->roles()
                    ->select('roles.id','roles.nombre','roles.slug')->first()
        ;

        $children = [];
        foreach ($padres as $line1) {
            $hijos = Menu::whereHas('roles', function ($query) use($roles) {
                        $query->where('role_id',$roles->id)->orderby('padre_id');
                    })->where('es_activo',1)->where('padre_id',$line1['id'])
                        ->orderby('orden')->get()->toArray();

            $children = array_merge($children, [array_merge($line1, ['submenu' => $hijos ])]);
        }
        return $children;
    }
}
