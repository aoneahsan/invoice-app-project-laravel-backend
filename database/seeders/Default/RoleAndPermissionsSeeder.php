<?php

namespace Database\Seeders\Default;

use App\Zaions\Enums\PermissionsEnum;
use App\Zaions\Enums\RolesEnum;
use App\Zaions\Helpers\ZSeederHelpers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class RoleAndPermissionsSeeder extends Seeder
{

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

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get/Create roles
        $superAdminRole = ZSeederHelpers::getRole(RolesEnum::superAdmin);
        $adminRole = ZSeederHelpers::getRole(RolesEnum::admin);
        $userRole = ZSeederHelpers::getRole(RolesEnum::user);
        $buyerRole = ZSeederHelpers::getRole(RolesEnum::buyer);
        $sellerRole = ZSeederHelpers::getRole(RolesEnum::seller);
        $buyerSellerRole = ZSeederHelpers::getRole(RolesEnum::buyerSeller);

        // Get/Create All permissions
        $allPermissions = $this->getAllPermissions();
        
        // Super Admin Permissions (can not be canBe_impersonate)
        $superAdminPermissions = array_filter($allPermissions, function ($permission) {
            return !Str::of($permission->name)->contains('canBe_impersonate');
        });

        // Admin Permissions 
        $adminPermissions = array_filter($allPermissions, function ($permission) {
            return !Str::of($permission->name)->contains('restore_') && !Str::of($permission->name)->contains('forceDelete_');
        });

        // User Permissions (can only update/delete his own data)
        $userPermissions = array_filter($adminPermissions, function ($permission) {
            return (!Str::of($permission->name)->contains('_user') && !Str::of($permission->name)->endsWith('_userSetting')) && !Str::of($permission->name)->contains('_role') && !Str::of($permission->name)->contains('_permission') && !Str::of($permission->name)->contains('Impersonate_');
        });

        // Assign permissions to roles
        $superAdminRole->syncPermissions($superAdminPermissions);
        $adminRole->syncPermissions($adminPermissions);
        $userRole->syncPermissions($userPermissions);
    }
}
