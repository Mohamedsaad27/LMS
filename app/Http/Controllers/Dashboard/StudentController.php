<?php

namespace App\Http\Controllers\Dashboard;

use App\Api\Requests\StudentRequests\StoreStudentRequest;
use App\Api\Requests\StudentRequests\UpdateStudentRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;
use App\Repository\Dashboard\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentRepository;
    public function __construct(StudentRepositoryInterface $studentRepository){
        $this->studentRepository = $studentRepository;
    }
    public function index(){
        $students = $this->studentRepository->index();
        return view('dashboard.student.index', compact('students'));
    }
    public function show(Student $student)
    {
        $student = $this->studentRepository->show($student);
        return view('dashboard.student.show', compact('student'));
    }
    public function create(){
        $data = $this->studentRepository->create();
        return view('dashboard.student.create', $data);
    }
    public function store(StoreStudentRequest $request)
    {
        $this->studentRepository->store($request);
        return redirect()->route('dashboard.student.index');
    }
    public function edit(Student $student){
        $data = $this->studentRepository->edit($student);
        return view('dashboard.student.edit', $data);
    }
    public function update(UpdateStudentRequest $request ,Student $student){
        $this->studentRepository->update($request, $student);
        return redirect()->route('dashboard.student.index')->with('success','Student updated successfully');
    }
    public function destroy(Student $student){
        $this->studentRepository->destroy($student);
        return redirect()->route('students.index')->with('success','Student deleted successfully');

    }
}
