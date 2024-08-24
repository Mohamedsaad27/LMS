<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $table = 'schools';
    protected $fillable = [
        'user_id',
        'publishing_house_id',
        'established_year',
        'description',
        'student_count',
        'teacher_count',
        'logo',
        'type',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function publishing_house(){
        return $this->belongsTo(PublishingHouse::class);
    }
    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function education_stages(){
        return $this->hasMany(EducationalStage::class);
    }
}
