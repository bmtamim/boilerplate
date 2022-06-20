<?php

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

if (!function_exists('SyncSuperAdminPermissions')) {


    function SyncSuperAdminPermissions()
    {
        $super_admin = Role::query()->where(['name' => 'super_admin'])->first();
        $permissions = Permission::query()->get()->pluck('id')->toArray();
        if (!is_null($permissions) && !empty($permissions)) {
            $super_admin->syncPermissions($permissions);
        }
    }
}
