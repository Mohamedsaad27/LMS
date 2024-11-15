<?php

namespace App\Interfaces;

use App\Api\Requests\OrganizationRequests\StoreOrganizationRequest;
use App\Api\Requests\OrganizationRequests\UpdateOrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

interface OrganizationRepositoryInterface
{
    public function index();
    public function show(Organization $organization);
    public function edit();
    public function create();
    
    public function store(StoreOrganizationRequest $request);
    public function update(UpdateOrganizationRequest $request, $id);
    public function destroy($id);
}
