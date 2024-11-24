<?php

namespace App\Interfaces;

use App\Api\Requests\GradeRequest\StoreGradeRequest;
use App\Api\Requests\GradeRequest\UpdateGradeRequest;
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