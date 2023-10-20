<?php
namespace App\Services\PermissionRole\Traits;

use App\Models\Role;
use App\Services\PermissionRole\Contracts\RoleContrat;

trait HasRolesTrait
{
    protected function getStoredRole($role): Role
    {
        if ($role instanceof \BackedEnum) {
            $role = $role->value;
        }

        if (is_int($role) || PermissionRegistrar::isUid($role)) {
            return $this->getRoleClass()::findById($role, $this->getDefaultGuardName());
        }

        if (is_string($role)) {
            return $this->getRoleClass()::findByName($role, $this->getDefaultGuardName());
        }

        return $role;
    }

    /**
     * Returns roles ids as array keys
     *
     * @param  string|int|array|Role|Collection|\BackedEnum  $roles
     */
    private function collectRoles(...$roles): array
    {
        return collect($roles)
            ->flatten()
            ->reduce(function ($array, $role) {
                if (empty($role)) {
                    return $array;
                }

                $role = $this->getStoredRole($role);
                if (! $role instanceof RoleContrat) {
                    return $array;
                }

                $this->ensureModelSharesGuard($role);

                $array[] = $role->getKey();

                return $array;
            }, []);
    }

    public static function syncRoles(...$roles) {
        if(self::getModel()->exists) {

        }
    }

}
