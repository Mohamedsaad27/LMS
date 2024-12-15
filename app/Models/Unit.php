<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Unit extends Model
{
    use HasFactory;
    protected $fillable = ['name_en','name_ar','description_en','description_ar','grade_id','subject_id'];
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }
}

