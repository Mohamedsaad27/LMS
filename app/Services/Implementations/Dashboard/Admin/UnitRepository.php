<?php

namespace App\Services\Implementations\Dashboard\Admin;

use App\Models\Unit;
use App\Models\Grade;
use App\Models\Subject;
use App\Http\Requests\UnitRequests\StoreUnitRequest;
use App\Http\Requests\UnitRequests\UpdateUnitRequest;
use App\Services\Interfaces\Dashboard\Admin\UnitRepositoryInterface;

class UnitRepository implements UnitRepositoryInterface
{
    private $unit;
    public function __construct(Unit $unit)
    {
        $this->unit = $unit;
    }
    public function index(){
        $units = $this->unit->with('grade', 'subject')->orderBy('id', 'desc')->get();
        return $units;
    }
    public function show(Unit $unit){
        $unit = $this->unit->with('grade', 'subject')->findOrFail($unit->id);
        return $unit;
    }
    public function create(){
        $grades = Grade::all();
        $subjects = Subject::all();
        return compact('grades', 'subjects');
    }
    public function store(StoreUnitRequest $request){
        $unit = $this->unit->create($request->validated());
        return $unit;
    }
    public function edit(Unit $unit){
        $grades = Grade::all();
        $subjects = Subject::all();
        return compact('grades', 'subjects', 'unit');
    }
    public function update(UpdateUnitRequest $request, Unit $unit){
        $unit->update($request->validated());
        return $unit;
    }
    public function destroy(Unit $unit){
        $unit->delete();
        return $unit;
    }
}
