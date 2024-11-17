<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use App\Http\Controllers\Controller;
use App\Interfaces\OrganizationRepositoryInterface;
use App\Api\Requests\OrganizationRequests\StoreOrganizationRequest;

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
        return view('dashboard.organization.index', compact('organizations'));
    }
    public function create()
    {
        $this->organizationRepository->create();
        return view('dashboard.organization.create');
    }
    public function store(StoreOrganizationRequest $request)
    {
        $this->organizationRepository->store($request);
        return redirect()->route('organizations.index')->with('success', 'Organization Created Succesfully');
    }
    public function show(Organization $organization)
    {
        $this->organizationRepository->show($organization);
    }// Controller Method
    public function edit(Organization $organization)
    {
        $organization = $this->organizationRepository->edit($organization);
        return view('dashboard.organization.edit', compact('organization'));
    }

}

