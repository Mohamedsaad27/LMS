<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest\StoreGradeRequest;
use App\Http\Requests\GradeRequest\UpdateGradeRequest;
use App\Models\Grade;
use App\Services\Interfaces\Dashboard\Admin\GradeRepositoryInterface;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    protected $gradeRepository;
    public function __construct(GradeRepositoryInterface $gradeRepositoryInterface)
    {
        $this->gradeRepository = $gradeRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $grades = $this->gradeRepository->index();

            return view("dashboard.admin.grade.index", compact("grades"));
        } catch (\Exception $e) {
            abort(500, 'An error occurred while fetching grades.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $educationalStages = $this->gradeRepository->create();

        return view("dashboard.admin.grade.create", compact('educationalStages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request)
    {
        try {
            $grade = $this->gradeRepository->store($request);

            return redirect()->route("grades.index")->with("success", __('dashboard.grade_created_successfully'));
        } catch (\Exception $e) {
            return redirect()->route("grades.create")->with("error", __('dashboard.error_occurred_try_again') . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        $educationalStages = $this->gradeRepository->edit();

        return view("dashboard.grade.edit", compact('educationalStages', 'grade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        try {
            $grade = $this->gradeRepository->update($request, $grade);

            return redirect()->route("grades.index")->with("success", __('dashboard.grade_updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->route("grades.edit", $grade)->with("error", __('dashboard.error_occurred_try_again'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        try {
            $this->gradeRepository->destroy($grade);

            return redirect()->route("grades.index")->with("success", __('dashboard.grade_deleted_successfully'));
        } catch (\Exception $e) {
            return redirect()->route("grades.index")->with("error", __('dashboard.error_occurred_try_again'));
        }
    }
}
