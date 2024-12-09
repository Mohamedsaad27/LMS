<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class School extends Model
{
    use HasFactory;
    protected $table = 'schools';
    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'email',
        'password',
        'phone',
        'address',
        'logo',
        'type',
        'organization_id',
        'max_students',
        'max_teachers'
    ];

    public function getNameAttribute()
    {
        $locale = App::getLocale();
        return $this->{"name_{$locale}"};
    }
    public function getDescriptionAttribute()
    {
        $locale = App::getLocale();
        return $this->{"description_{$locale}"};
    }

    public function educationalStage()
    {
        return $this->belongsToMany(EducationalStage::class, 'educational_stage_school');
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'school_grade');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'school_subject');
    }

}
