<?php

namespace App\Zaions\Helpers;

use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ZSeederHelpers
{
    /** get role */
    static public function getRole(RolesEnum $role)
    {
        $role = Role::firstOrCreate(['name' => $role->value]);
        return $role;
    }

    // Get all permissions
    function getAllPermissions()
    {
        $allPermissionsCases = PermissionsEnum::cases();
        $allPermissions = [];

        foreach ($allPermissionsCases as $permission) {
            $permissionName = $permission->value;

            $allPermissions[] = Permission::firstOrCreate(['name' => $permissionName]);
        }

        return $allPermissions;
    }
}
