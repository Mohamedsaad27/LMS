<?php

namespace App\Repository;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Interfaces\CrudInterface;
use App\Http\Resources\TeacherResource;
use App\Interfaces\TeacherRepositoryInterface;
use App\Api\Requests\TeacherRequests\StoreTeacherRequest;
use App\Api\Requests\TeacherRequests\UpdateTeacherRequest;

class TeacherRepository implements TeacherRepositoryInterface
{
    use ApiResponseTrait;
    public function index(){
        try{
            $teachers = Teacher::with('school','user','subjects')->get();
            return $this->successResponse(TeacherResource::collection($teachers),trans('messages.teacher_retrieved_successfully'), 200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function create(){}
    public function store(StoreTeacherRequest $request){
        try{
            $teacher = Teacher::create([
                'user_id' => auth()->user()->id,
                'school_id' => auth()->user()->school_id,
                'specialization' => $request->specialization,
                'years_of_experience' => $request->years_of_experience,
                'hire_date' => $request->hire_date,
                'salary' => $request->salary,
                'status' => $request->status,
                'additional_info' => $request->additional_info,
                'photo' => $request->photo,
                'date_of_birth' => $request->date_of_birth,
            ]);

            return $this->successResponse(new TeacherResource($teacher),trans('messages.teacher_created_successfully'), 201);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function show($id){}
    public function edit($id){}
    public function update(UpdateTeacherRequest $request, $id){
        try{
            $teacher = Teacher::find($id);
            if(!$teacher){
                return $this->errorResponse(trans('messages.teacher_not_found'), 404);
            }
            if($request->hasFile('photo')){
                $imagePath = $request->file('photo')->storeAs(
                    'user_images/' . $teacher->id,
                    time() . '_' . $request->file('photo')->getClientOriginalName(),
                    'public'
                );
                $imageUrl = asset('storage/' . $imagePath);
                $validated['photo'] = $imageUrl;
            }
            $teacher->update($request->validated());
            return $this->successResponse(new TeacherResource($teacher),trans('messages.teacher_updated_successfully'), 200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    public function destroy($id){
        try{
            $teacher = Teacher::find($id);
            if(!$teacher){
                return $this->errorResponse(trans('messages.teacher_not_found'), 404);
            }
            if($teacher->user_id != auth()->user()->id){
                return $this->errorResponse(trans('messages.unauthorized_access'), 403);
            }
            
            $teacher->delete();
            return $this->successResponse(null,trans('messages.teacher_deleted_successfully'), 200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

}
