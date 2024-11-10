<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $fillable = [
        'grade_id',
        'organization_id',
        'name',
        'description',
    ];
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function book(){
        return $this->hasOne(Book::class);
    }
    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    public function units(){
        return $this->hasMany(Unit::class);
    }
}
