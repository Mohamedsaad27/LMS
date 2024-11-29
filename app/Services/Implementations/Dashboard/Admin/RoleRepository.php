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
        // Implementation for store method
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        // Implementation for update method
    }

    public function destroy($id)
    {
        // Implementation for destroy method
    }
}