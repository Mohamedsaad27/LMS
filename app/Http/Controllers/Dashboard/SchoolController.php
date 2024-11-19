<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\SchoolRepositoryInterface;
use App\Api\Requests\SchoolRequests\StoreSchoolRequest;
use App\Api\Requests\SchoolRequests\UpdateSchoolRequest;

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
        return view('dashboard.schools.index', compact('schools'));
    }

    public function create()
    {
        $organizations = $this->schoolRepository->create();
        return view('dashboard.schools.create', compact('organizations'));
    }

    public function store(StoreSchoolRequest $request)
    {
        $this->schoolRepository->store($request);
        return redirect()->route('schools.index')->with('success', 'School created successfully');
    }

    public function show($id)
    {
        $school = $this->schoolRepository->show($id);
        return view('dashboard.schools.show', compact('school'));
    }

    public function edit($id)
    {
        $school = $this->schoolRepository->edit($id);
        return view('dashboard.schools.edit', $school);
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
