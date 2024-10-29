<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'organization_id'
    ];
    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

}
