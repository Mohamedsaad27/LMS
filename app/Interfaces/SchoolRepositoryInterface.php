<?php

namespace App\Interfaces;

use App\Api\Requests\OrganizationRequests\StoreOrganizationRequest;
use App\Api\Requests\OrganizationRequests\UpdateOrganizationRequest;
use App\Api\Requests\SchoolRequests\StoreSchoolRequest;
use App\Api\Requests\SchoolRequests\UpdateSchoolRequest;
use Illuminate\Http\Request;

interface SchoolRepositoryInterface
{
    public function index();
    public function store(StoreSchoolRequest $request);
    public function show($id);
    public function update(UpdateSchoolRequest $request, $id);
    public function destroy($id);
}
