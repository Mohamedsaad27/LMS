<?php

namespace App\Services;

use App\Models\ResetPasswordCodeVerification;
use App\Notifications\SendResetPasswordCodeNotification;
use Illuminate\Support\Facades\Notification;

class SendResetPasswordCodeService
{
    public function sendResetPasswordCode(string $email) :void {
        Notification::route('mail', $email)->notify(new SendResetPasswordCodeNotification($this->generateResetPasswordCode($email)));
    }
    public function generateResetPasswordCode($email) :string
    {
        $checkIfCodeIfExists = ResetPasswordCodeVerification::where('email', $email)->first();
        if ($checkIfCodeIfExists) $checkIfCodeIfExists->delete();

        $code = rand(10000, 99999);

        ResetPasswordCodeVerification::create([
            'email' => $email,
            'code' => $code,
            'expired_at' => now()->addMinutes(30),
            'is_verified' => false,
        ]);

        return $code;
    }
}
