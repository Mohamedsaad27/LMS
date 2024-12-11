<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequests\StoreSubjectRequest;
use App\Http\Requests\SubjectRequests\UpdateSubjectRequest;
use App\Services\Interfaces\Dashboard\Admin\SubjectRepositoryInterface;

class SubjectController extends Controller
{
    protected $subjectRepository;
    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }
    public function index()
    {
        $subjects = $this->subjectRepository->index();
        return view('dashboard.admin.subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->subjectRepository->create();
        return view('dashboard.admin.subject.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        $this->subjectRepository->store($request);
        return redirect()->route('subjects.index')->with('success', __('messages.subject_added_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $subject = $this->subjectRepository->show($subject);
        return view('dashboard.admin.subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $data = $this->subjectRepository->edit($subject);
        return view('dashboard.admin.subject.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $this->subjectRepository->update($request, $subject);
        return redirect()->route('subjects.index')->with('success', __('messages.subject_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $this->subjectRepository->destroy($subject);
        return redirect()->route('subjects.index')->with('success', __('messages.subject_deleted_successfully'));
    }
}
