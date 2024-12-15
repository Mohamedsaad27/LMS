<?php

namespace App\Http\Controllers\Web\Dashboard\Admin;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequests\StoreUnitRequest;
use App\Http\Requests\UnitRequests\UpdateUnitRequest;
use App\Services\Interfaces\Dashboard\Admin\UnitRepositoryInterface;

class UnitController extends Controller
{
    protected $unitRepository;
    public function __construct(UnitRepositoryInterface $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }
    public function index()
    {
        $units = $this->unitRepository->index();
        return view('dashboard.admin.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->unitRepository->create();
        return view('dashboard.admin.units.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
       $this->unitRepository->store($request);
        return redirect()->route('units.index')->with('success', trans('messages.unit_created_successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        $unit = $this->unitRepository->show($unit);
        return view('dashboard.admin.units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        $data = $this->unitRepository->edit($unit);
        return view('dashboard.admin.units.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $unit = $this->unitRepository->update($request, $unit);
        return redirect()->route('units.index')->with('success', trans('messages.unit_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $this->unitRepository->destroy($unit);
        return redirect()->route('units.index')->with('success', trans('messages.unit_deleted_successfully'));
    }
}
