<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\PermissionServices;
use App\Services\SyncPermissionsToRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin_role   = Role::query()->updateOrCreate([
            'name'         => 'super_admin',
            'display_name' => 'Super Admin',
            'guard_name'   => 'web',
            'description'  => 'Admin is allowed to manage everything of the app.',
        ]);
        $admin_role         = Role::query()->updateOrCreate([
            'name'         => 'admin',
            'display_name' => 'Admin',
            'guard_name'   => 'web',
            'description'  => 'Admin is allowed to manage everything of the app except role and permissions.',
        ]);
        $salesman_role      = Role::query()->updateOrCreate([
            'name'         => 'customer',
            'display_name' => 'Customer',
            'guard_name'   => 'web',
            'description'  => 'Customer is allowed to manage everything related their account.',
        ]);

        $user = User::query()->where(['email' => 'admin@gmail.com', 'is_deletable' => false])->first();
        if ($user) {
            $user->assignRole('super_admin');
        }

        //Dashboard
        Permission::query()->updateOrCreate([
            'name'         => 'dashboard',
            'guard_name'   => 'web',
            'module'       => 'Dashboard',
            'display_name' => 'Dashboard',
        ]);

        //Role & Permissions Method
        (new PermissionServices())->createAll('role_permission', 'Role And Permissions');


        //Settings Permissions
        Permission::query()->updateOrCreate([
            'name'         => 'general_settings',
            'guard_name'   => 'web',
            'module'       => 'Settings',
            'display_name' => 'General Settings',
        ]);
        Permission::query()->updateOrCreate([
            'name'         => 'profile_settings',
            'guard_name'   => 'web',
            'module'       => 'Settings',
            'display_name' => 'Profile Settings',
        ]);

        //Users
        (new PermissionServices())->createAll('user', 'User');

        (new PermissionServices())->createAll('customer', 'Customer');

        (new SyncPermissionsToRole())->superAdmin();

        Cache::forget('roles_list');
    }
}
