<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Http\Requests\TeacherRequests\StoreTeacherRequest;
use App\Http\Requests\TeacherRequests\UpdateTeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;

interface TeacherRepositoryInterface
{
    public function index();
    public function show(Teacher $teacher);
    public function create();   
    public function store(StoreTeacherRequest $request);
    public function edit(Teacher $teacher);
    public function update(UpdateTeacherRequest $request, Teacher $teacher);
    public function destroy(Teacher $teacher);
}
