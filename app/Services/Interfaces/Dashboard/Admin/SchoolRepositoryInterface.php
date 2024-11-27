<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Http\Requests\SchoolRequests\StoreSchoolRequest;
use App\Http\Requests\SchoolRequests\UpdateSchoolRequest;
use Illuminate\Http\Request;

interface SchoolRepositoryInterface
{
    public function index();
    public function create();
    public function store(StoreSchoolRequest $request);
    public function show($id);
    public function edit($id);
    public function update(UpdateSchoolRequest $request, $id);
    public function destroy($id);
}
