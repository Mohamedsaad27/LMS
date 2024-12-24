<?php

namespace App\Services\Implementations\Dashboard\Admin;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Requests\SubjectRequests\StoreSubjectRequest;
use App\Http\Requests\SubjectRequests\UpdateSubjectRequest;
use App\Services\Interfaces\Dashboard\Admin\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface
{
    protected $model;

    public function __construct(Subject $subject)
    {
        $this->model = $subject;
    }

    public function index()
    {
        $subjects = $this->model->with('grade', 'organization', 'book', 'units', 'teachers')->get();
        return $subjects;
    }
    public function create()
    {
        $grades = Grade::all();
        $organizations = Organization::all();
        return compact('grades', 'organizations');
    }
    public function store(StoreSubjectRequest $request)
    {
        $data = $request->validated();
        $subject = $this->model->create($data);
        return $subject;
    }
    public function show(Subject $subject)
    {
        $subject = $this->model->with('grade', 'teachers', 'organization', 'book', 'units')->find($subject->id);
        return $subject;
    }
    public function edit(Subject $subject)
    {
        $grades = Grade::all();
        $organizations = Organization::all();
        return compact('grades', 'organizations', 'subject');
    }
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $data = $request->validated();
        $subject->update($data);
        return $subject;
    }
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return true;
    }
}