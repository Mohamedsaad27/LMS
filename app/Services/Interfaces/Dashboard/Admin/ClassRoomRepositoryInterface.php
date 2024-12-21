<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Http\Requests\ClassRoomRequests\StoreClassRoomRequest;
use App\Http\Requests\ClassRoomRequests\UpdateClassRoomRequest;
use App\Models\ClassRoom;

interface ClassRoomRepositoryInterface
{
    public function index();
    public function show(ClassRoom $classRoom);
    public function create();
    public function store(StoreClassRoomRequest $request);
    public function edit(ClassRoom $classRoom);
    public function update(UpdateClassRoomRequest $request, ClassRoom $classRoom);
    public function destroy(ClassRoom $classRoom);
}
