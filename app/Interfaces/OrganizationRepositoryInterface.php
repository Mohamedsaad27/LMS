<?php

namespace App\Interfaces;

use App\Api\Requests\OrganizationRequests\StoreOrganizationRequest;
use App\Api\Requests\OrganizationRequests\UpdateOrganizationRequest;
use Illuminate\Http\Request;

interface OrganizationRepositoryInterface
{
    public function index();
    public function store(StoreOrganizationRequest $request);
    public function update(Request $request, $id);
    public function destroy($id);
}
