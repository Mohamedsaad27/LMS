<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Grade extends Model
{
    use HasFactory;
    protected $table = 'grades';
    protected $fillable = ['educational_stage_id', 'name_en', 'name_ar', 'description_en', 'description_ar'];

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

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
