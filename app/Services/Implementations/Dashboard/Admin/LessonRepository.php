<?php

namespace App\Services\Implementations\Dashboard\Admin;

use App\Models\Unit;
use App\Models\Lesson;
use App\Models\Subject;
use App\Http\Requests\LessonRequest\StoreLessonRequest;
use App\Http\Requests\LessonRequest\UpdateLessonRequest;
use App\Services\Interfaces\Dashboard\Admin\LessonRepositoryInterface;

class LessonRepository implements LessonRepositoryInterface
{
    public function __construct(private Lesson $lesson){
        $this->lesson = $lesson;
    }
    public function index(){
        $lessons = $this->lesson->with('unit')->get();
        return $lessons;
    }
    public function show(Lesson $lesson){
        $lesson = $this->lesson->with('unit')->find($lesson->id);
        return $lesson;
    }
    public function create(){
        $units = Unit::all();
        return $units;
    }
    public function store(StoreLessonRequest $request){
        $validated = $request->validated();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $imagePath = 'Uploads/lessons/'.$imageName;
            $image->move(public_path('Uploads/lessons'), $imageName);
            $validated['image'] = $imagePath;
        }
        $lesson = $this->lesson->create($validated);
        return $lesson;
    }
    public function edit(Lesson $lesson){
        $units = Unit::all();
        $lesson = $this->lesson->with('unit')->find($lesson->id);
        return compact('lesson', 'units');
    }
    public function update(UpdateLessonRequest $request, Lesson $lesson){
        $validated = $request->validated();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $imagePath = 'Uploads/lessons/'.$imageName;
            $image->move(public_path('Uploads/lessons'), $imageName);
            $validated['image'] = $imagePath;
        }
        $lesson->update($validated);
        return $lesson;
    }
    public function destroy(Lesson $lesson){
        $lesson->delete();
        return $lesson;
    }
}
