<?php

namespace App\Services\Implementations\Dashboard\Admin;

use App\Http\Requests\ClassRoomRequests\StoreClassRoomRequest;
use App\Http\Requests\ClassRoomRequests\UpdateClassRoomRequest;
use App\Models\ClassRoom;
use App\Services\Interfaces\Dashboard\Admin\ClassRoomRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ClassRoomRepository implements ClassRoomRepositoryInterface
{
    private $classRoom;

    public function __construct(ClassRoom $classRoom)
    {
        $this->classRoom = $classRoom;
    }

    public function index()
    {
        return $this->classRoom->with('grade', 'school')->get();
    }

    public function show(ClassRoom $classRoom)
    {
        return $this->classRoom->with('grade', 'school')->find($classRoom->id);
    }

    public function create()
    {
        $grades = DB::Table('grades')->select('id', 'name_en', 'name_ar')->get();
        $schools = DB::Table('schools')->select('id', 'name_en', 'name_ar')->get();
        return compact('grades', 'schools');
    }

    public function store(StoreClassRoomRequest $request)
    {
        $validated = $request->validated();
        $classRoom = $this->classRoom->create($validated);
        return $classRoom;
    }

    public function edit(ClassRoom $classroom)
    {
        $grades = DB::table('grades')->select('id', 'name_en', 'name_ar')->get();
        $schools = DB::table('schools')->select('id', 'name_en', 'name_ar')->get();

        return [
            'grades' => $grades,
            'schools' => $schools
        ];
    }

    public function update(UpdateClassRoomRequest $request, ClassRoom $classRoom)
    {
        $validated = $request->validated();
        $classRoom->update($validated);
        return $classRoom;
    }

    public function destroy(ClassRoom $classRoom)
    {
        $classRoom->delete();
        return true;
    }
}
