<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequests\StoreTeacherRequest;
use App\Http\Requests\TeacherRequests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Services\Interfaces\Dashboard\Admin\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $teacherRepository;

    public function __construct(TeacherRepositoryInterface $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = $this->teacherRepository->index();
        
        return view('dashboard.admin.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->teacherRepository->create();
        $schools = $data['schools'];
        $grades = $data['grades']; 
        $subjects = $data['subjects'];
        
        return view('dashboard.admin.teacher.create', compact('schools', 'grades', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        try {
            $teacher = $this->teacherRepository->store($request);

            return redirect()->route('teachers.index')->with('success', __('dashboard.teacher_created_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('dashboard.teacher_creation_failed') . ' ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('dashboard.admin.teacher.show' , compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $teacher = $this->teacherRepository->edit($teacher);
        $schools = $this->teacherRepository->create()['schools'];
        $grades = $this->teacherRepository->create()['grades']; 
        $subjects = $this->teacherRepository->create()['subjects'];
        
        return view('dashboard.admin.teacher.edit', compact('teacher', 'schools', 'grades', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        try {
            $this->teacherRepository->update($request, $teacher);

            return redirect()->route('teachers.index')->with('success', __('dashboard.teacher_updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('teachers.edit', $teacher)->with('error', __('dashboard.teacher_update_failed'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        try {
            $this->teacherRepository->destroy($teacher);

            return redirect()->route('teachers.index')->with('success', __('dashboard.teacher_deleted_successfully'));
        } catch (\Exception $e) {
            return redirect()->route('teachers.index')->with('error', __('dashboard.teacher_deletion_failed'));
        }
    }
}
