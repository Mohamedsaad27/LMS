<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPasswordCodeVerification extends Model
{
    use HasFactory;
    protected $table = 'reset_password_code_verification';
    protected $fillable = ['email','code','is_verified','expired_at'];

}
