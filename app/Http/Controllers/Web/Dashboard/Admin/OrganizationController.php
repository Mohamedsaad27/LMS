<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationRequests\StoreOrganizationRequest;
use App\Http\Requests\OrganizationRequests\UpdateOrganizationRequest;
use App\Services\Interfaces\Dashboard\Admin\OrganizationRepositoryInterface;

class OrganizationController extends Controller
{
    protected $organizationRepository;
    public function __construct(OrganizationRepositoryInterface $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }
    public function index(Request $request)
    {
        $organizations = $this->organizationRepository->index();
        return view('dashboard.admin.organization.index', compact('organizations'));
    }
    public function create()
    {
        $organizations = $this->organizationRepository->create();
        return view('dashboard.admin.organization.create');
    }
    public function store(StoreOrganizationRequest $request)
    {
        $this->organizationRepository->store($request);
        return redirect()->route('organizations.index')->with('success', 'Organization Created Succesfully');
    }
    public function show(Organization $organization)
    {
        $organization = $this->organizationRepository->show($organization);
        return view('dashboard.admin.organization.show', compact('organization'));
    }// Controller Method
    public function edit(Organization $organization)
    {
        $organization = $this->organizationRepository->edit($organization);
        return view('dashboard.admin.organization.edit', compact('organization'));
    }
    public function update(UpdateOrganizationRequest $request, $id)
    {
        $this->organizationRepository->update($request, $id);
        return redirect()->route('organizations.index')->with('success', 'Organization updated successfully');
    }
    public function destroy($id)
    {
        $this->organizationRepository->destroy($id);
        return redirect()->back()->with('success', 'Organization deleted successfully');
    }
}

