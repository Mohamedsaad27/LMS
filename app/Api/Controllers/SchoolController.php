<?php

namespace App\Api\Controllers;

use App\Api\Requests\SchoolRequests\StoreSchoolRequest;
use App\Api\Requests\SchoolRequests\UpdateSchoolRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\SchoolRepositoryInterface;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    protected $schoolsRepository;

    public function __construct(SchoolRepositoryInterface $schoolsRepository)
    {
        $this->schoolsRepository = $schoolsRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->schoolsRepository->index();
    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolRequest $request)
    {
      return $this->schoolsRepository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->schoolsRepository->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolRequest $request, string $id)
    {
        return $this->schoolsRepository->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->schoolsRepository->destroy($id);
    }
}
