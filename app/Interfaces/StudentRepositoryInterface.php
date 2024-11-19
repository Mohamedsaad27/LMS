<?php

namespace App\Interfaces;

use App\Api\Requests\StudentRequests\StoreStudentRequest;
use App\Api\Requests\StudentRequests\UpdateStudentRequest;
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
