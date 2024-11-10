<?php
namespace App\Repository;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Resources\UnitResource;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\UnitRepositoryInterface;

class UnitRepository implements UnitRepositoryInterface{
    use ApiResponseTrait;
    protected $unit;
    public function __construct(Unit $unit){
        $this->unit = $unit;
    }
    public function index(){
        try{
            $units = $this->unit->with('grade')->get();
            return $this->successResponse(UnitResource::collection($units),trans('messages.Unit_retrieved_successfully'),200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(),trans('messages.server_error'), 500);
        }
    }
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name_ar' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'grade_id' => 'nullable|exists:grades,id',
                'subject_id' => 'nullable|exists:subjects,id',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), trans('messages.validation_error'), 422);
            }
            $unit = $this->unit->create($validator->validated());
            return $this->successResponse(new UnitResource($unit),trans('messages.Unit_created_successfully'),200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(),trans('messages.server_error'), 500);
        }
    }
    public function update(Request $request, $id){
        try{
            $validator = Validator::make($request->all(), [
                'name_ar' => 'required|string|max:255',
                'name_en' => 'required|string|max:255',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'grade_id' => 'nullable|exists:grades,id',
                'subject_id' => 'nullable|exists:subjects,id',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), trans('messages.validation_error'), 422);
            }
            $unit = $this->unit->findOrFail($id);
            $unit->update($validator->validated());
            return $this->successResponse(new UnitResource($unit),trans('messages.Unit_updated_successfully'),200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(),trans('messages.server_error'), 500);
        }
    }
    public function destroy($id){
        try{
            $unit = $this->unit->findOrFail($id);
            $unit->delete();
            return $this->successResponse(null,trans('messages.Unit_deleted_successfully'),200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(),trans('messages.server_error'), 500);
        }
    }
}
