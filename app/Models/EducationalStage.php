<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalStage extends Model
{
    use HasFactory;
    protected $table = 'educational_stages';
    protected $fillable = ['name','description','school_id'];

    function school(){
        return $this->belongsTo(School::class);
    }
    public function grades(){
        return $this->hasMany(Grade::class);
    }

}
