<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'description_ar', 'description_en', 'unit_id', 'image'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
