<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest\StoreLessonRequest;
use App\Http\Requests\LessonRequest\UpdateLessonRequest;
use App\Services\Interfaces\Dashboard\Admin\LessonRepositoryInterface;

class LessonController extends Controller
{
    private $lessonRepository;
    public function __construct(LessonRepositoryInterface $lessonRepository){
        $this->lessonRepository = $lessonRepository;
    }
    public function index()
    {
        $lessons = $this->lessonRepository->index();
        return view('dashboard.admin.lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = $this->lessonRepository->create();
        return view('dashboard.admin.lessons.create', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request)
    {
        $lesson = $this->lessonRepository->store($request);
        return redirect()->route('lessons.index')->with('success', trans('messages.lesson_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        $lesson = $this->lessonRepository->show($lesson);
        return view('dashboard.admin.lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        $lesson = $this->lessonRepository->edit($lesson);
        return view('dashboard.admin.lessons.edit', $lesson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson = $this->lessonRepository->update($request, $lesson);
        return redirect()->route('lessons.index')->with('success', trans('messages.lesson_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson = $this->lessonRepository->destroy($lesson);
        return redirect()->route('lessons.index')->with('success', trans('messages.lesson_deleted'));
    }
}
