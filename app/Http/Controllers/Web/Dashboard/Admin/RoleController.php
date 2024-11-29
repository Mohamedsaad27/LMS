<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\Dashboard\Admin\RoleRepositoryInterface;
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
