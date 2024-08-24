<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $table = 'grades';
    protected $fillable = ['stage_id','name','description'];
    public function educational_stage(){
        return $this->belongsTo(EducationalStage::class);
    }
    public function classrooms(){
        return $this->hasMany(Classroom::class);
    }
}
