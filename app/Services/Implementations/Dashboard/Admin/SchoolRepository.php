<?php

namespace App\Services\Implementations\Dashboard\Admin;

use App\Http\Requests\SchoolRequests\StoreSchoolRequest;
use App\Http\Requests\SchoolRequests\UpdateSchoolRequest;
use App\Models\Grade;
use App\Models\Organization;
use App\Models\School;
use App\Models\Subject;

use App\Services\Interfaces\Dashboard\Admin\SchoolRepositoryInterface;

class SchoolRepository implements SchoolRepositoryInterface
{
    protected $school;

    public function __construct(School $school)
    {
        $this->school = $school;
    }

    public function index()
    {
        $schools = $this->school->with('teachers', 'students', 'classrooms')->get();
        return $schools;
    }

    public function create()
    {
        $organizations = Organization::all();
        $grades = Grade::all();
        $subjects = Subject::all();
        return compact('organizations', 'grades', 'subjects');
    }

    public function store(StoreSchoolRequest $request)
    {
        $validated = $request->validated();
        try {
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $imageName = 'Uploads/schools/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Uploads/schools'), $imageName);
                $validated['logo'] = $imageName;
            }
            $school = $this->school->create($validated);
            $school->grades()->attach($validated['grades']);
            $school->subjects()->attach($validated['subjects']);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $school = $this->school->find($id);
        return $school;
    }

    public function edit(School $school)
    {
        $organizations = Organization::all();
        $grades = Grade::all();
        $subjects = Subject::all();
        return compact('school', 'organizations', 'grades', 'subjects');
    }

    public function update(UpdateSchoolRequest $request, $id)
    {
        $validated = $request->validated();
        try {
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $imageName = 'Uploads/schools/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Uploads/schools'), $imageName);
                $validated['logo'] = $imageName;
                // Remove past image
                $school = $this->school->find($id);
                if ($school->logo && file_exists(public_path($school->logo))) {
                    unlink(public_path($school->logo));
                }
            }
            $this->school->find($id)->update($validated);
            $school->grades()->sync($validated['grades']);
            $school->subjects()->sync($validated['subjects']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $this->school->find($id)->delete();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
