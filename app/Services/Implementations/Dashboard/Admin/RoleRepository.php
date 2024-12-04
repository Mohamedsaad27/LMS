<?php

namespace App\Services\Implementations\Dashboard\Admin;

use App\Http\Requests\RoleRequest\StoreRoleRequest;
use App\Http\Requests\RoleRequest\UpdateRoleRequest;
use App\Services\Interfaces\Dashboard\Admin\RoleRepositoryInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{

    public function index()
    {
        $roles = Role::all();

        return $roles;
    }

    public function show(Role $role)
    {
        // Implementation for show method
    }

    public function edit(Role $role)
    {
        // Implementation for edit method
    }

    public function create()
    {
        $permissions = Permission::all();

        return $permissions;
    }

    public function store(StoreRoleRequest $request)
    {
        try {
            $data = $request->validated();

            $role = Role::create(['name' => $request->role, 'guard_name' => 'web'])->givePermissionTo($request->permissions);
            return $role;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            $data = $request->validated();

            $roleUpdated = $role->update([
                'name' => $request->name
            ]);

            if ($request->has('permissions')) {
                $role->revokePermissionTo($request->permissions);
            }

            return $roleUpdated;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function destroy($role)
    {
        try {
            $role->delete();
            return $role;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}