<?php

namespace App\Repository\Dashboard;

use App\Api\Requests\GradeRequest\StoreGradeRequest;
use App\Api\Requests\GradeRequest\UpdateGradeRequest;
use App\Interfaces\GradeRepositoryInterface;
use App\Models\EducationalStage;
use App\Models\Grade;

class GradeRepository implements GradeRepositoryInterface
{

    public function index()
    {
        try {
            $grades = Grade::all();
            return $grades;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function show(Grade $grade)
    {

    }

    public function edit()
    {
        try {
            $educationalStages = EducationalStage::all();
            return $educationalStages;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function create()
    {
        try {
            $educationalStages = EducationalStage::all();
            return $educationalStages;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function store(StoreGradeRequest $request)
    {
        try {
            $grade = Grade::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'educational_stage_id' => $request->educational_stage_id,
            ]);

            return $grade;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function update(UpdateGradeRequest $request, $grade)
    {
        try {
            $grade->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'educational_stage_id' => $request->educational_stage_id,
            ]);

            return $grade;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function destroy($grade)
    {
        try {
            $grade->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}