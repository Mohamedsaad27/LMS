<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;
    protected $table = 'classrooms';
    protected $fillable = [
        'grade_id',
        'school_id',
        'name',
        'capacity',
        'description'
    ];
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function school(){
        return $this->belongsTo(School::class);
    }
}
