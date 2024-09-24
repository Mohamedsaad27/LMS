<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'user_id',
        'school_id',
        'grade_id',
        'date_of_birth',
        'enrollment_date',
        'grade',
        'parent_contact',
        'photo',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function school(){
        return $this->belongsTo(School::class);
    }
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
