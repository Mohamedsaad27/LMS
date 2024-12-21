<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRoomRequests\StoreClassRoomRequest;
use App\Http\Requests\ClassRoomRequests\UpdateClassRoomRequest;
use App\Models\ClassRoom;
use App\Services\Interfaces\Dashboard\Admin\ClassRoomRepositoryInterface;

class ClassRoomController extends Controller
{
    protected $classroom_repository;

    public function __construct(ClassRoomRepositoryInterface $classroom_repository)
    {
        $this->classroom_repository = $classroom_repository;
    }

    public function index()
    {
        $classrooms = $this->classroom_repository->index();
        return view('dashboard.admin.classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->classroom_repository->create();
        return view('dashboard.admin.classrooms.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassRoomRequest $request)
    {
        $this->classroom_repository->store($request);
        return redirect()->route('classrooms.index')->with('success', 'Classroom created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassRoom $classroom)
    {
        $classroom = $this->classroom_repository->show($classroom);
        return view('dashboard.admin.classrooms.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $classroom)
    {
        $data = $this->classroom_repository->edit($classroom);
        return view('dashboard.admin.classrooms.edit', [
            'classroom' => $classroom,
            'grades' => $data['grades'],
            'schools' => $data['schools']
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassRoomRequest $request, ClassRoom $classroom)
    {
        $this->classroom_repository->update($request, $classroom);
        return redirect()->route('classrooms.index')->with('success', 'Classroom updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $classroom)
    {
        $this->classroom_repository->destroy($classroom);
        return redirect()->route('classrooms.index')->with('success', 'Classroom deleted successfully');
    }
}
