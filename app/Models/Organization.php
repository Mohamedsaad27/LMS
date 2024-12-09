<?php

namespace App\Models;

use App\Models\School;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;
    protected $table = 'organizations';
    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'email',
        'password',
        'phone',
        'address',
        'logo',
        'established_year',
        'max_schools'
    ];
    public function schools()
    {
        return $this->hasMany(School::class);
    }
    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}
