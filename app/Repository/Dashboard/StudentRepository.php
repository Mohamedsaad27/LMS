<?php

namespace App\Repository\Dashboard;

use App\Models\User;
use App\Models\Grade;
use App\Models\School;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\StudentRepositoryInterface;
use App\Api\Requests\StudentRequests\StoreStudentRequest;
use App\Api\Requests\StudentRequests\UpdateStudentRequest;

class StudentRepository implements StudentRepositoryInterface
{
    private $student;
    public function __construct(Student $student)
    {
        $this->student = $student;
    }
    public function index()
    {
        $students = $this->student->with('user', 'school', 'grade')->get();
        return $students;
    }
    public function create()
    {
        $schools = DB::Table('schools')->select('id', 'name_en')->get();
        $grades = DB::Table('grades')->select('id', 'name')->get();
        return compact('schools', 'grades');
    }
    public function store(StoreStudentRequest $request)
    {
        $validated = $request->validated();
        try {
            DB::beginTransaction();
            $user = User::create([
                'name_en' => $validated['name_en'],
                'name_ar' => $validated['name_ar'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'gender' => $validated['gender'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'user_type' => 'student',
                'is_verified' => 1,
            ]);
            if ($request->hasFile('photo')) {
                $image = $request->file(key: 'photo');
                $imageName = 'Uploads/Students/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Uploads/Students'), $imageName);
                $validated['photo'] = $imageName;
            }
            $student = $this->student->create([
                'user_id' => $user->id,
                'school_id' => $validated['school_id'],
                'date_of_birth' => $validated['date_of_birth'],
                'parent_contact' => $validated['parent_contact'],
                'photo' => $validated['photo'],
                'grade_id' => $validated['grade_id'],
            ]);
            DB::commit();
            if ($student && $user) {
                return redirect()->route('students.index')->with('success', 'Student created successfully');
            }
        } catch (\Exception $e) {
            Log::error('Error creating student: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function show(Student $student)
    {
         $student = $this->student->with('user', 'school', 'grade')->find($student->id);
         return $student;
    }   
    public function edit(Student $student)
    {
        $schools = DB::Table('schools')->select('id', 'name_en')->get();
        $grades = DB::Table('grades')->select('id', 'name')->get();
        return compact('student', 'schools', 'grades');
    }
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validated = $request->validated();
        try {
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imagePath = 'Uploads/Students/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Uploads/Students'), $imagePath);
                $validated['photo'] = $imagePath;
                if ($student->photo && file_exists(public_path($student->photo))) {
                    unlink(public_path($student->photo));
                }
            }
            DB::beginTransaction();
            $user = User::find($student->user_id);
            $user->update([
                'name_en' => $validated['name_en'],
                'name_ar' => $validated['name_ar'],
                'email' => $validated['email'],
                'gender' => $validated['gender'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'is_verified' => 1,
            ]);
            $student->update([
                'school_id' => $validated['school_id'],
                'date_of_birth' => $validated['date_of_birth'],
                'parent_contact' => $validated['parent_contact'],
                'photo' => $validated['photo'],
                'grade_id' => $validated['grade_id'],
            ]);
            DB::commit();
            return redirect()->route('students.index')->with('success', 'Student updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return redirect()->route('students.index')->with('success', 'Student deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
