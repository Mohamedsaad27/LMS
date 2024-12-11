<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Http\Requests\SubjectRequests\StoreSubjectRequest;
use App\Http\Requests\SubjectRequests\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

interface SubjectRepositoryInterface
{
    public function index();
    Public function create();
    public function store(StoreSubjectRequest $request);
    public function show(Subject $subject);
    public function edit(Subject $subject);
    public function update(UpdateSubjectRequest $request, Subject $subject);
    public function destroy(Subject $subject);
}
