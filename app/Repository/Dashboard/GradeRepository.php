<?php

namespace App\Repository\Dashboard;

use App\Api\Requests\GradeRequest\StoreGradeRequest;
use App\Api\Requests\GradeRequest\UpdateGradeRequest;
use App\Interfaces\GradeRepositoryInterface;
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

    public function edit(Grade $grade)
    {

    }

    public function create()
    {

    }
    public function store(StoreGradeRequest $request)
    {
        try {
            $grade = Grade::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return $grade;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function update(UpdateGradeRequest $request, $id)
    {

    }
    public function destroy($id)
    {

    }
}