<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class EducationalStage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getNameAttribute()
    {
        $locale = App::getLocale();
        return $this->{"name_{$locale}"};
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'educational_stage_school');
    }
}
