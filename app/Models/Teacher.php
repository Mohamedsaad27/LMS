<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';
    protected $fillable = [
        'user_id',
        'school_id',
        'hire_date',
        'qualification',
        'subject_specialization',
        'experience_years',
        'status',
        'photo',
        'salary',
        'date_of_birth'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function school(){
        return $this->belongsTo(School::class);
    }
    public function subjects(){
        return $this->belongsToMany(Subject::class);
    }
}
