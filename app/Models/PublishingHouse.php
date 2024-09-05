<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishingHouse extends Model
{
    use HasFactory;
    protected $table = 'publishing_houses';
    protected $fillable = [
        'user_id',
        'logo',
        'established_year',
        'description_en',
        'description_ar',
        'total_books',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
