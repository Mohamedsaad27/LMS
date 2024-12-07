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
        return $this->teacher->with('user', 'school')->get();
    }

    public function show(Teacher $teacher)
    {
        return $teacher->load('user', 'school');
    }

    public function update(UpdateTeacherRequest $request, $id)
    {
        $validated = $request->validated();
        try {
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imagePath = 'Uploads/Teachers/' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('Uploads/Teachers'), $imagePath);
                $validated['photo'] = $imagePath;

                $teacher = $this->teacher->findOrFail($id);
                if ($teacher->photo && file_exists(public_path($teacher->photo))) {
                    unlink(public_path($teacher->photo));
                }
            }

            DB::beginTransaction();
            
            $teacher = $this->teacher->findOrFail($id);
            $user = User::find($teacher->user_id);
            
            $user->update([
                'name_en' => $validated['name_en'],
                'name_ar' => $validated['name_ar'],
                'email' => $validated['email'],
                'gender' => $validated['gender'],
                'phone' => $validated['phone'],
                'address' => $validated['address']
            ]);

            $teacher->update([
                'school_id' => $validated['school_id'],
                'photo' => $validated['photo'] ?? $teacher->photo,
                'specialization' => $validated['specialization']
            ]);

            DB::commit();
            return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating teacher: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $teacher = $this->teacher->findOrFail($id);
            if ($teacher->photo && file_exists(public_path($teacher->photo))) {
                unlink(public_path($teacher->photo));
            }
            $teacher->delete();
            return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting teacher: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
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
        $schools = School::all();
        return view('dashboard.admin.teacher.edit', compact('teacher', 'schools'));
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
                'address' => $request->address
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
                'specialization' => $request->specialization
            ]);

            DB::commit();
            return $teacher;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
