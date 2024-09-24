<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $table = 'publishing_houses';
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
    ];
    public function schools()
    {
        return $this->hasMany(School::class);
    }
    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}
