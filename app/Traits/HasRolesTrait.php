<?php
namespace App\Traits;


trait HasRolesTrait
{
    /**
     * role assing
     * @param mixed $role
     *
     * @return [type]
     */
    public function asignarRole($role)
    {
        $this->roles()->sync($role);
    }

    /**
     * tieneRole verify
     * @param mixed $role
     *
     * @return [type]
     */
    public function tieneRole($role)
    {
        return (bool) $this->roles()->where('slug', $role)->count();
    }
}
