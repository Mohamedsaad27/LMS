<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Http\Requests\RoleRequest\StoreRoleRequest;
use App\Http\Requests\RoleRequest\UpdateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
{
    public function index();
    public function show(Role $role);
    public function edit(Role $role);
    public function create();
    public function store(Request $request);
    public function update(UpdateRoleRequest $request, Role $role);
    public function destroy(Role $role);
}
