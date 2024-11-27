<?php

namespace App\Services\Implementations\Dashboard\Admin;

use App\Http\Requests\OrganizationRequests\StoreOrganizationRequest;
use App\Http\Requests\OrganizationRequests\UpdateOrganizationRequest;
use Toastr;
use App\Models\Organization;
use App\Services\Interfaces\Dashboard\Admin\OrganizationRepositoryInterface;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;

class OrganizationRepository implements OrganizationRepositoryInterface
{


    public function index()
    {
        $organizations = DB::table('organizations')->orderBy('id', 'desc')->get();
        return $organizations;
    }
    public function show(Organization $organization)
    {
        return $organization;
    }

    public function create()
    {

    }
    public function store(StoreOrganizationRequest $request)
    {
        $validatedData = $request->validated();
        try {
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $imageName = 'Uploads/organizations/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Uploads/organizations'), $imageName);
                $validatedData['logo'] = $imageName;
            }
            Organization::create($validatedData);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit(Organization $organization)
    {
        return $organization;
    }

    public function update(UpdateOrganizationRequest $request, $id)
    {
        $validatedData = $request->validated();
        try {
            $organization = Organization::findOrFail($id);
            $organization->update($validatedData);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->delete();
    }
}
