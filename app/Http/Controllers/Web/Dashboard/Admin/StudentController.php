<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequests\StoreStudentRequest;
use App\Http\Requests\StudentRequests\UpdateStudentRequest;
use App\Models\Student;
use App\Services\Interfaces\Dashboard\Admin\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentRepository;
    public function __construct(StudentRepositoryInterface $studentRepository){
        $this->studentRepository = $studentRepository;
    }
    public function index(){
        $students = $this->studentRepository->index();
        return view('dashboard.admin.student.index', compact('students'));
    }
    public function show(Student $student)
    {
        $student = $this->studentRepository->show($student);
        return view('dashboard.admin.student.show', compact('student'));
    }
    public function create(){
        $data = $this->studentRepository->create();
        return view('dashboard.admin.student.create', $data);
    }
    public function store(StoreStudentRequest $request)
    {
        $this->studentRepository->store($request);
        return redirect()->route('students.index');
    }
    public function edit(Student $student){
        $data = $this->studentRepository->edit($student);
        return view('dashboard.admin.student.edit', $data);
    }
    public function update(UpdateStudentRequest $request ,Student $student){
        $this->studentRepository->update($request, $student);
        return redirect()->route('students.index')->with('success', trans('messages.student_updated_successfully'));
    }
    public function destroy(Student $student){
        $this->studentRepository->destroy($student);
        return redirect()->route('students.index')->with('success', trans('messages.student_deleted_successfully'));

    }
}
