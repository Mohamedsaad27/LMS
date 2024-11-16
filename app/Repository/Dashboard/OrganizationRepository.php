<?php 

namespace App\Repository\Dashboard;
use App\Models\Organization;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;
use  App\Interfaces\OrganizationRepositoryInterface;
use App\Api\Requests\OrganizationRequests\StoreOrganizationRequest;
use App\Api\Requests\OrganizationRequests\UpdateOrganizationRequest;

class OrganizationRepository implements OrganizationRepositoryInterface
{

    
    public function index()
    {
        $organizations = DB::table('organizations')->orderBy('id','desc')->get();
        return $organizations;
    }
    public function show(Organization $organization){
        return $organization;
    }

    public function create(){

    }
    public function store(StoreOrganizationRequest $request){
        
    }
    public function edit()
    {
        
    }
    
    public function update(UpdateOrganizationRequest $request,$id)
    {
        
    }
  
    public function destroy($id){

    }
}
