<?php

namespace App\Repository;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Interfaces\StudentRepositoryInterface;
use Illuminate\Support\Facades\File;
use App\Http\Resources\StudentResource;

class StudentRepository implements StudentRepositoryInterface
{
    use ApiResponseTrait;
    public function index(){
        $students = Student::with('school','grade','user')->get();
        return $this->successResponse(StudentResource::collection($students),trans('messages.students_fetched_successfully'));
    }
 
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'school_id' => 'required|exists:schools,id',
            'grade_id' => 'required|exists:grades,id',
            'date_of_birth' => 'required|date',
            'enrollment_date' => 'required|date',
            'parent_contact' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $iamgeName = time().'.'.$request->photo->extension();
            $iamgePath = public_path('uploads/images/students');
            if(!File::isDirectory(public_path($iamgePath))){
                File::makeDirectory($iamgePath, 0777, true,true);
            }
            $image->move(public_path($iamgePath), $iamgeName);
            $validatedData['photo'] = env('APP_URL'). '/' . $iamgePath.'/'.$iamgeName;
        }
        $student = Student::find($id);
        $student->update($validatedData);
        return $this->successResponse(new StudentResource($student),trans('messages.student_updated_successfully'));
    }
    public function destroy($id){
        $student = Student::find($id);
        if(!$student){
            return $this->errorResponse(trans('messages.student_not_found'),404);
        }
        $student->delete();
        return $this->successResponse(null,trans('messages.student_deleted_successfully'));
    }

}
