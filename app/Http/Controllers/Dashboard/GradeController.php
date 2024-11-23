<?php

namespace App\Http\Controllers\Dashboard;

use App\Api\Requests\GradeRequest\StoreGradeRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\GradeRepositoryInterface;
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

            return view("dashboard.grade.index", compact("grades"));
        } catch (\Exception $e) {
            abort(500, 'An error occurred while fetching grades.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.grade.create");
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
            return redirect()->route("grades.create")->with("error", __('dashboard.error_occurred_try_again'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
