<?php

namespace App\Api\Controllers;

use App\Api\Requests\OrganizationRequests\StoreOrganizationRequest;
use App\Api\Requests\OrganizationRequests\UpdateOrganizationRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\OrganizationRepositoryInterface;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    protected $organizationRepository;
    public function __construct(OrganizationRepositoryInterface $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }


    public function index()
    {
        return $this->organizationRepository->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->organizationRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request)
    {
        return $this->organizationRepository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->organizationRepository->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->organizationRepository->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationRequest $request, string $id)
    {
        return $this->organizationRepository->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->organizationRepository->destroy($id);

    }
}
