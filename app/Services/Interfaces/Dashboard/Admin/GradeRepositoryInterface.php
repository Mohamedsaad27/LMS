<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Http\Requests\GradeRequest\StoreGradeRequest;
use App\Http\Requests\GradeRequest\UpdateGradeRequest;
use App\Models\Grade;

interface GradeRepositoryInterface{
    public function index();
    public function show(Grade $grade);
    public function edit();
    public function create();
    public function store(StoreGradeRequest $request);
    public function update(UpdateGradeRequest $request, Grade $grade);
    public function destroy(Grade $grade);
}