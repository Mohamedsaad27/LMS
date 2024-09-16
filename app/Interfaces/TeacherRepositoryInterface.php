<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Api\Requests\TeacherRequests\StoreTeacherRequest;
use App\Api\Requests\TeacherRequests\UpdateTeacherRequest;

interface TeacherRepositoryInterface
{
    public function index();
    public function store(StoreTeacherRequest $request);
    public function show($id);
    public function update(UpdateTeacherRequest $request, $id);
    public function destroy($id);
}
