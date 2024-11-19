<?php

namespace App\Repository\Dashboard;

use App\Models\School;
use App\Models\Organization;
use App\Interfaces\SchoolRepositoryInterface;
use App\Api\Requests\SchoolRequests\StoreSchoolRequest;
use App\Api\Requests\SchoolRequests\UpdateSchoolRequest;

class SchoolRepository implements SchoolRepositoryInterface
{
    protected $school;
    public function __construct(School $school)
    {
        $this->school = $school;
    }
    public function index(){
        $schools = $this->school->with('teachers','students','classrooms')->all();
        return $schools;
    }
    public function create(){
        $organizations = Organization::all();
        return $organizations;
    }
    public function store(StoreSchoolRequest $request){
        $validated = $request->validated();
        try{
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $imageName = 'Uploads/schools/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Uploads/schools'), $imageName);
                $validated['logo'] = $imageName;
            }
            $this->school->create($validated);
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function show($id){
        $school = $this->school->find($id);
        return $school;
    }
    public function edit($id){
        $school = $this->school->find($id);
        $organizations = Organization::all();
        return compact('school', 'organizations');
    }
    public function update(UpdateSchoolRequest $request, $id){
        $validated = $request->validated();
        try{
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $imageName = 'Uploads/schools/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Uploads/schools'), $imageName);
                $validated['logo'] = $imageName;
                // Remove past image
                $school = $this->school->find($id);
                if($school->logo && file_exists(public_path($school->logo))){
                    unlink(public_path($school->logo));
                }
            }
            $this->school->find($id)->update($validated);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function destroy($id){
        try{
            $this->school->find($id)->delete();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
