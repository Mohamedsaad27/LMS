<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Http\Requests\TeacherRequests\UpdateTeacherRequest;
use Illuminate\Http\Request;

interface TeacherRepositoryInterface
{
    public function index();
    public function show($id);
    public function update(UpdateTeacherRequest $request, $id);
    public function destroy($id);
}
