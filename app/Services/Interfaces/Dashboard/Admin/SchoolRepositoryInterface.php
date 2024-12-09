<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Models\School;
use Illuminate\Http\Request;
use App\Http\Requests\SchoolRequests\StoreSchoolRequest;
use App\Http\Requests\SchoolRequests\UpdateSchoolRequest;

interface SchoolRepositoryInterface
{
    public function index();
    public function create();
    public function store(StoreSchoolRequest $request);
    public function show($id);
    public function edit(School $school);
    public function update(UpdateSchoolRequest $request, $id);
    public function destroy($id);
}
