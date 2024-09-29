<?php

namespace App\Repository;

use App\Api\Requests\SchoolRequests\StoreSchoolRequest;
use App\Api\Requests\SchoolRequests\UpdateSchoolRequest;
use App\Http\Resources\SchoolResource;
use App\Interfaces\CrudInterface;
use App\Interfaces\SchoolRepositoryInterface;
use App\Models\Organization;
use App\Models\School;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SchoolRepositoryRepository implements SchoolRepositoryInterface
{
    use ApiResponseTrait;
    public function index(){
        try {
            $schools = School::with('organization')->get();
            if($schools->isEmpty()){
                return $this->errorResponse(trans('messages.no_schools'),404);
            }
            return $this->successResponse(SchoolResource::Collection($schools),trans('messages.schools_retrieved_successfully'));
        }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage(),trans('messages.server_error'), 500);
        }
    }
    public function create(){}
    public function store(StoreSchoolRequest $request){

    }
    public function show($id){
        try {
            $school = School::with(['user','organization'])->findOrFail($id);
            return $this->successResponse( new SchoolResource($school),trans('messages.school_retrieved_successfully'));
        }catch (ModelNotFoundException $exception){
            return $this->errorResponse(trans('messages.school_not_found'),404);
        }
        catch (\Exception $exception){
            return $this->errorResponse(trans('messages.server_error'), 500);
        }
    }
    public function edit($id){}

    public function update(UpdateSchoolRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $school = School::find($id);

            if (!$school) {
                return $this->errorResponse(trans('messages.school_not_found'), 404);
            }

            if (!auth()->user()->hasRole('publishing-house')) {
                return $this->errorResponse(trans('messages.unauthorized_access_to_school'), 403);
            }
            if ($request->hasFile('logo')) {
                // Store the image in storage/user_images/{{user_id}} directory
                $imagePath = $request->file('logo')->storeAs(
                    'user_images/' . $school->id,
                    time() . '_' . $request->file('user_image')->getClientOriginalName(),
                    'public'
                );

                // Generate full URL
                $imageUrl = asset('storage/' . $imagePath);
                $validated['logo'] = $imageUrl;
            }

            // Assign the publishing house id
            $publishingHouseId = Organization::where('user_id', Auth::user()->id)->first()->id;
            $validated['publishing_house_id'] = $publishingHouseId;

            // Use fill method for mass assignment
            $school->fill($validated);

            $school->save();

            return $this->successResponse(new SchoolResource($school), trans('messages.school_updated_successfully'));

        } catch (ModelNotFoundException $exception) {
            return $this->errorResponse(trans('messages.school_not_found'), 404);
        } catch (ValidationException $exception) {
            return $this->errorResponse($exception->errors(), 422);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }

    public function destroy($id){
            try {
                $school = School::find($id);
                if (!$school) {
                    return $this->errorResponse(trans('messages.school_not_found'),404);
                }
                if(!auth()->user()->hasRole('publishing-house')){
                    return $this->errorResponse(trans('messages.unauthorized_access_to_school'),403);
                }
                $user = User::find($school->user_id);
                if ($school->logo) {
                    $logoPath = public_path('storage/' . $school->logo);
                    if (file_exists($logoPath)) {
                        unlink($logoPath);
                    }
                }
                foreach ($school->education_stages as $education_stage) {
                    $education_stage->update(['school_id' => null]);
                }
                DB::commit();
                $school->delete();
                if ($user) {
                    $user->delete();
                }
                DB::beginTransaction();
                return $this->successResponse(trans('messages.school_deleted_successfully'));
            }catch (\Exception $exception){
                DB::rollBack();
                return $this->errorResponse($exception->getMessage(), 500);
            }
        }

}
