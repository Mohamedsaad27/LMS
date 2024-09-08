<?php

namespace App\Repository;

use App\Http\Resources\SchoolResource;
use App\Interfaces\CrudInterface;
use App\Interfaces\SchoolInterface;
use App\Models\School;
use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SchoolRepository implements SchoolInterface
{
    use ApiResponseTrait;
    public function index(){
        try {
            $schools = School::with(['user','publishing_house'])->get();
            if($schools->isEmpty()){
                return $this->errorResponse(trans('messages.no_schools'),404);
            }
            return $this->successResponse(trans('messages.schools_retrieved_successfully'),SchoolResource::Collection($schools));
        }catch (\Exception $exception){
            return $this->errorResponse(trans('messages.server_error'), 500);
        }
    }
    public function create(){}
    public function store(Request $request){}
    public function show($id){
        try {
            $school = School::with(['user','publishing_house'])->findOrFail($id);
            return $this->successResponse( new SchoolResource($school),trans('messages.school_retrieved_successfully'),200);
        }catch (ModelNotFoundException $exception){
            return $this->errorResponse(trans('messages.school_not_found'),404);
        }
        catch (\Exception $exception){
            return $this->errorResponse(trans('messages.server_error'), 500);
        }
    }
    public function edit($id){}
    public function update(Request $request, $id){}
    public function destroy($id){}

}
