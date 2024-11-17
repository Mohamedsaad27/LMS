<?php 

namespace App\Repository\Dashboard;
use Toastr;
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
        $validatedData = $request->validated();
        try{
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $imageName = 'Uploads/organizations/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Uploads/organizations'), $imageName);
                $validatedData['logo'] = $imageName;
            }
            Organization::create($validatedData);
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit(Organization $organization)
    {
        
    }
    
    public function update(UpdateOrganizationRequest $request,$id)
    {
        
    }
  
    public function destroy($id){

    }
}
