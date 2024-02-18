<?php

namespace App\Models\Roles\Contracts;

use App\Models\Roles\Permission;

/**
 * Contract for permissionable objects
 */
interface AuthorizesPermissions
{
    public function hasPermission(Permission $permission): bool;
}
