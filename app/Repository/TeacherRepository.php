<?php

namespace App\Repository;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Interfaces\CrudInterface;
use Illuminate\Support\Facades\File;
use App\Http\Resources\TeacherResource;
use App\Interfaces\TeacherRepositoryInterface;
use App\Api\Requests\TeacherRequests\StoreTeacherRequest;
use App\Api\Requests\TeacherRequests\UpdateTeacherRequest;

class TeacherRepository implements TeacherRepositoryInterface
{
    use ApiResponseTrait;
    public function index(){
        try{
            $teachers = Teacher::with('school','user')->get();
            return $this->successResponse(TeacherResource::collection($teachers),trans('messages.teacher_retrieved_successfully'), 200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(),trans('messages.error_occurred'), 500);
        }
    }
    public function show($id){
        try{
            $teacher = Teacher::with('school','user')->find($id);
            if(!$teacher){
                return $this->errorResponse(null,trans('messages.teacher_not_found'), 404);
            }
            return $this->successResponse(new TeacherResource($teacher),trans('messages.teacher_retrieved_successfully'), 200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(),trans('messages.error_occurred'), 500);
        }
    }
    public function update(UpdateTeacherRequest $request, $id){
        try{
            $validated = $request->validated();
            $teacher = Teacher::find($id);
            if(!$teacher){
                return $this->errorResponse(null,trans('messages.teacher_not_found'), 404);
            }
            if($request->hasFile('photo')){
                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('uploads/images/teachers');
                if(!File::isDirectory(public_path($imagePath))){
                    File::makeDirectory($imagePath, 0777, true,true);
                }
                $image->move(public_path($imagePath), $imageName);
                $validated['photo'] = env('APP_URL'). '/' . $imagePath.'/'.$imageName;
            }
            $teacher->update($validated);
            return $this->successResponse(new TeacherResource($teacher),trans('messages.teacher_updated_successfully'), 200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(),trans('messages.error_occurred'), 500);
        }
    }
    public function destroy($id){
        try{
            $teacher = Teacher::find($id);
            if(!$teacher){
                return $this->errorResponse(null,trans('messages.teacher_not_found'), 404);
            }
            $teacher->user->delete();
            $teacher->delete();
            return $this->successResponse(null,trans('messages.teacher_deleted_successfully'), 200);
        }catch(\Exception $e){
            return $this->errorResponse($e->getMessage(),trans('messages.error_occurred'), 500);
        }
    }

}
