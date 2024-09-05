<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_en',
        'name_ar',
        'email',
        'password',
        'verification_code',
        'expired_at',
        'is_verified',
        'user_type_id',
        'gender',
        'address',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function type()
    {
     return $this->belongsTo(UserType::class, 'user_type_id');
    }
    public function publishing_house(){
        return $this->hasone(PublishingHouse::class, 'user_id');
    }
    public function teacher(){
        return $this->hasone(Teacher::class, 'user_id');
    }
    public function student(){
        return $this->hasOne(Student::class, 'user_id');
    }
    public function school(){
        return $this->hasOne(School::class, 'user_id');
    }
    public function admin(){
        return $this->hasOne(Admin::class, 'user_id');
    }
}
