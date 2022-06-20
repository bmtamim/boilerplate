<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SyncPermissionsToRole
{
    public function superAdmin()
    {
        $super_admin = Role::query()->where(['name' => 'super_admin'])->first();
        $permissions = Permission::query()->get()->pluck('id')->toArray();
        if (!is_null($permissions) && !empty($permissions)) {
            $super_admin->syncPermissions($permissions);
        }
    }
}
