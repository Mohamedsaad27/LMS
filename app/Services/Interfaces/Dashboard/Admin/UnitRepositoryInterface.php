<?php

namespace App\Services\Interfaces\Dashboard\Admin;

use App\Models\Unit;
use App\Http\Requests\UnitRequests\StoreUnitRequest;
use App\Http\Requests\UnitRequests\UpdateUnitRequest;

interface UnitRepositoryInterface
{
    public function index();
    public function show(Unit $unit);
    public function create();
    public function store(StoreUnitRequest $request);
    public function edit(Unit $unit);
    public function update(UpdateUnitRequest $request, Unit $unit);
    public function destroy(Unit $unit);
}
