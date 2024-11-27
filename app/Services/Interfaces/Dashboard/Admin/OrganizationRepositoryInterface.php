<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Http\Requests\OrganizationRequests\StoreOrganizationRequest;
use App\Http\Requests\OrganizationRequests\UpdateOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

interface OrganizationRepositoryInterface
{
    public function index();
    public function show(Organization $organization);
    public function edit(Organization $organization);
    public function create();
    public function store(StoreOrganizationRequest $request);
    public function update(UpdateOrganizationRequest $request, $id);
    public function destroy($id);
}
