<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequests\StoreSchoolRequest;
use App\Http\Requests\SchoolRequests\UpdateSchoolRequest;
use App\Models\Grade;
use App\Models\Organization;
use App\Models\School;
use App\Models\Subject;
use App\Services\Interfaces\Dashboard\Admin\SchoolRepositoryInterface;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    protected $schoolRepository;

    public function __construct(SchoolRepositoryInterface $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }

    public function index()
    {
        $schools = $this->schoolRepository->index();
        return view('dashboard.admin.schools.index', compact('schools'));
    }

    public function create()
    {
        $organizations = Organization::all();
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('dashboard.admin.schools.create', compact('organizations', 'grades', 'subjects'));
    }

    public function store(StoreSchoolRequest $request)
    {
        $this->schoolRepository->store($request);
        return redirect()->route('schools.index')->with('success', 'School created successfully');
    }

    public function show($id)
    {
        $school = $this->schoolRepository->show($id);
        return view('dashboard.admin.schools.show', compact('school'));
    }

    public function edit(School $school)
    {
        $organizations = Organization::all();
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('dashboard.admin.schools.edit', compact('school', 'organizations', 'grades', 'subjects'));
    }

    public function update(UpdateSchoolRequest $request, $id)
    {
        $this->schoolRepository->update($request, $id);
        return redirect()->route('schools.index')->with('success', 'School updated successfully');
    }

    public function destroy($id)
    {
        $this->schoolRepository->destroy($id);
        return redirect()->route('schools.index')->with('success', 'School deleted successfully');
    }
}
