<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\SendVerificationCodeNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class SendVerificationCodeService
{
    public  function sendVerificationCode(object $user):void{
    Notification::send($user,new SendVerificationCodeNotification($this->generateVerificationCode($user->email)));
    }
    public  function generateVerificationCode($email){
       $user = User::where('email', $email)->first();
       if($user){
           $user->update([
               'verification_code' => null
           ]);
           $code = rand(100000, 999999);
           $user->update([
               'verification_code' => $code,
               'expired_at' => Carbon::now()->addMinutes(30),
               'is_verified' => false
           ]);
           return $code;
       }
    }
}
