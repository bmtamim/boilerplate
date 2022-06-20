<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;

class PermissionServices
{
    public function createAll($name, $module)
    {
        Permission::query()->updateOrCreate([
            'name'         => $name . '_view',
            'guard_name'   => 'web',
            'module'       => $module,
            'display_name' => 'View',
        ]);
        Permission::query()->updateOrCreate([
            'name'         => $name . '_create',
            'guard_name'   => 'web',
            'module'       => $module,
            'display_name' => 'Create',
        ]);
        Permission::query()->updateOrCreate([
            'name'         => $name . '_edit',
            'guard_name'   => 'web',
            'module'       => $module,
            'display_name' => 'Edit',
        ]);
        Permission::query()->updateOrCreate([
            'name'         => $name . '_delete',
            'guard_name'   => 'web',
            'module'       => $module,
            'display_name' => 'Delete',
        ]);
    }

}
