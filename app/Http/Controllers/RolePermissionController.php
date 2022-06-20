<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolePermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index()
    {
        CheckPermission('role_permission_view');
        $roles = Role::query()->orderBy('created_at')->get();
        return view('settings.role.index', compact('roles'));
    }

    public function edit($id)
    {
        CheckPermission('role_permission_edit');

        $role             = Role::query()->with(['permissions'])->findOrFail($id);
        $modules          = Permission::query()->get()->groupBy('module');
        $role_permissions = $role->permissions->pluck('id')->toArray();
        return view('settings.role.edit', compact('role', 'modules', 'role_permissions'));
    }

    public function update(RolePermissionRequest $request, $id)
    {
        CheckPermission('role_permission_edit');

        $role = Role::query()->with(['permissions'])->findOrFail($id);
        $data = $request->validated();
        try {
            $role->update([
                'display_name' => $data['display_name'],
                'description'  => $data['description'],
            ]);
            if (is_array($request->permissions)) {
                $role->syncPermissions($request->permissions);
            }
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => __('Role Updated!'),
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => __('Failed To Update Role!'),
            ]);
        }
        return redirect()->route('settings.roles.edit', $role->id);

    }
}
