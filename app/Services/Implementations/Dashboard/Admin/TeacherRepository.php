<?php

namespace App\Services\Implementations\Dashboard\Admin;

use App\Models\Grade;
use App\Models\School;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use App\Services\Interfaces\Dashboard\Admin\TeacherRepositoryInterface;
use App\Http\Requests\TeacherRequests\UpdateTeacherRequest;
use App\Http\Requests\TeacherRequests\StoreTeacherRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TeacherRepository implements TeacherRepositoryInterface
{
    protected $teacher;

    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    public function index()
    {
        $teachers = Teacher::with(['user', 'school', 'grades', 'subjects'])
            ->latest()
            ->paginate(10);
        return $teachers;
    }


    public function show(Teacher $teacher)
    {
        return $teacher->load('user', 'school');
    }

    public function destroy(Teacher $teacher)
    {
        try {
            DB::beginTransaction();
            if ($teacher->photo && file_exists(public_path($teacher->photo))) {
                unlink(public_path($teacher->photo));
            }

            $teacher->delete();
            $teacher->user->delete();
            $teacher->grades()->detach();
            $teacher->subjects()->detach();

            DB::commit();
    
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function create()
    {
        $schools = School::all();
        $grades = Grade::all();
        $subjects = Subject::all();

        return compact('schools', 'grades', 'subjects');
    }

    public function edit(Teacher $teacher)
    {
        return $teacher->load('user', 'school', 'grades', 'subjects');
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $validated = $request->validated();
        try {
            DB::beginTransaction();

            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imagePath = 'Uploads/Teachers/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Uploads/Teachers'), $imagePath);
                $validated['photo'] = $imagePath;

                if ($teacher->photo && file_exists(public_path($teacher->photo))) {
                    unlink(public_path($teacher->photo));
                }
            }

            $teacher->user->update([
                'name_en' => $validated['name_en'],
                'name_ar' => $validated['name_ar'],
                'email' => $validated['email'],
                'gender' => $validated['gender'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'status' => $validated['status'],
                'password' => Hash::make($validated['password']),
            ]);

            $teacher->update([
                'school_id' => $validated['school_id'],
                'photo' => $validated['photo'] ?? $teacher->photo,
                'status' => $validated['status'],
                'salary' => $validated['salary'],
                'date_of_birth' => $validated['date_of_birth'],
                'hire_date' => $validated['hire_date'],
                'qualification' => $validated['qualification'],
                'experience_years' => $validated['experience_years'],
            ]);

            if ($request->grades) {
                $teacher->grades()->sync($request->grades);
            } else {
                $teacher->grades()->detach();
            }
            if ($request->subjects) {
                $teacher->subjects()->sync($request->subjects);
            } else {
                $teacher->subjects()->detach();
            }

            DB::commit();
            return $teacher;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function store(StoreTeacherRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => 'teacher',
                'status' => 'active',
            ]);

            $imagePath = null;
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imagePath = 'Uploads/Teachers/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Uploads/Teachers'), $imagePath);
            }

            $teacher = $this->teacher->create([
                'user_id' => $user->id,
                'school_id' => $request->school_id,
                'photo' => $imagePath,
                'status' => $request->status,
                'salary' => $request->salary,
                'date_of_birth' => $request->date_of_birth,
                'hire_date' => $request->hire_date,
                'qualification' => $request->qualification,
                'experience_years' => $request->experience_years,
            ]);

            if ($request->grades) {
                $teacher->grades()->sync($request->grades);
            }
            if ($request->subjects) {
                $teacher->subjects()->sync($request->subjects);
            }

            DB::commit();
            return $teacher;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
