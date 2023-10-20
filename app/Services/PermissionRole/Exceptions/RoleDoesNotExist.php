<?php

namespace App\Services\PermissionRole\Exceptions;

use InvalidArgumentException;

class RoleDoesNotExist extends InvalidArgumentException
{
    /**
     * @param string $roleName
     *
     * @return [type]
     */
    public static function named(string $roleName)
    {
        return new static("There is no role named `{$roleName}`.");
    }

    /**
     * @param  int|string  $roleId
     * @return static
     */
    public static function withId($roleId)
    {
        return new static("There is no role with ID `{$roleId}`.");
    }
}
