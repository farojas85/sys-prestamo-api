<?php
namespace App\Traits;


trait HasRolesTrait
{
    public function asignarRole($role)
    {
        $this->roles()->sync($role);
    }
}
