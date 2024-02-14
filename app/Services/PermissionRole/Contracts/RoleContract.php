<?php

namespace App\Services\PermissionRole\Contracts;

interface RoleContract
{
    /**
     * Find a role by its name and guard name.
     *
     *
     * @throws \Spatie\Permission\Exceptions\RoleDoesNotExist
     */
    public static function findByName(string $name, ?string $guardName): self;

    /**
     * Find a role by its id and guard name.
     *
     *
     * @throws \Spatie\Permission\Exceptions\RoleDoesNotExist
     */
    public static function findById(int|string $id, ?string $guardName): self;

    /**
     * Find or create a role by its name and guard name.
     */
    public static function findOrCreate(string $name, ?string $guardName): self;

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  string|\Spatie\Permission\Contracts\Permission  $permission
     */
    public function hasPermissionTo($permission, ?string $guardName): bool;
}
