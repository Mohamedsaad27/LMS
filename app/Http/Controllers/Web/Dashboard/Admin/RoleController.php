<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest\StoreRoleRequest;
use App\Http\Requests\RoleRequest\UpdateRoleRequest;
use App\Services\Interfaces\Dashboard\Admin\RoleRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $roleRepository;
    public function __construct(RoleRepositoryInterface $roleRepositoryInterface)
    {
        $this->roleRepository = $roleRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $roles = $this->roleRepository->index();

        return view('dashboard.admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->roleRepository->create();

        return view('dashboard.admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            $role = $this->roleRepository->store($request);

            return redirect()->route('roles.index')->with('success', __('dashboard.role_created_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('roles.create')->with('error', __('dashboard.error_occurred_try_again'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            $updateRole = $this->roleRepository->update($request, $role);

            return redirect()->route('roles.index')->with('success', __('dashboard.role_updated_successfully'));
        } catch (Exception $e) {
            return redirect()->route('roles.index')->with('error', __('dashboard.error_occurred_try_again'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            $role = $this->roleRepository->destroy($role);
            return redirect()->route('roles.index')->with('success', __('dashboard.role_deleted_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('roles.index')->with('error', __('dashboard.error_occurred_try_again'));
        }
    }
}
