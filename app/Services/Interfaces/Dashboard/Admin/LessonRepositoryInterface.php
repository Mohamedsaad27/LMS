<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Models\Unit;
use App\Models\Lesson;
use App\Http\Requests\UnitRequests\StoreUnitRequest;
use App\Http\Requests\UnitRequests\UpdateUnitRequest;
use App\Http\Requests\LessonRequest\StoreLessonRequest;
use App\Http\Requests\LessonRequest\UpdateLessonRequest;

interface LessonRepositoryInterface
{
    public function index();
    public function show(Lesson $lesson);
    public function create();
    public function store(StoreLessonRequest $request);
    public function edit(Lesson $lesson);
    public function update(UpdateLessonRequest $request, Lesson $lesson);
    public function destroy(Lesson $lesson);
}
