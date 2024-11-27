<?php

namespace App\Services\Interfaces;

use App\Http\Requests\AuthRequests\ChangePasswordRequest;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\RegistrationRequest;
use App\Http\Requests\AuthRequests\ResetPasswordRequest;
use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function login(LoginRequest $loginRequest);
    public function register(RegistrationRequest $registrationRequest);
    public function logout(Request $request);
    public function profile();
    public function resetPassword(ResetPasswordRequest $resetPasswordRequest);
    public function sendResetPasswordCode(Request $request);
    public function refreshToken(Request $request);
    public function verifyEmail(Request $request);
    public function changePassword(ChangePasswordRequest $changePasswordRequest);
    public function verifyResetPasswordCode(Request $request);
    public function resendRegistrationCode(Request $request);
}
