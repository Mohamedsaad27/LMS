<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Http\Requests\StudentRequests\StoreStudentRequest;
use App\Http\Requests\StudentRequests\UpdateStudentRequest;
use App\Models\Student;

interface StudentRepositoryInterface
{
    public function index();
    public function create();
    public function show(Student $student);
    public function store(StoreStudentRequest $request);
    public function edit(Student $student);
    public function update(UpdateStudentRequest $request, Student $student);
    public function destroy(Student $student);
}
