<?php

namespace App\Repository;

use App\Api\Requests\AuthRequests\ChangePasswordRequest;
use App\Api\Requests\AuthRequests\ForgotPasswordRequest;
use App\Api\Requests\AuthRequests\LoginRequest;
use App\Api\Requests\AuthRequests\RegistrationRequest;
use App\Api\Requests\AuthRequests\ResetPasswordRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class AuthRepository implements AuthRepositoryInterface
{
    use ApiResponseTrait;
    public function login(LoginRequest $loginRequest){

    }
    public function register(RegistrationRequest $registrationRequest){

    }
    public function logout(){

    }
    public function profile(){

    }
    public function resetPassword(ResetPasswordRequest $resetPasswordRequest){

    }
    public function sendResetPasswordCode(Request $request){

    }
    public function refreshToken(){

    }
    public function forgotPassword(ForgotPasswordRequest $forgotPasswordRequest){

    }
    public function verifyEmail(Request $request){

    }
    public function changePassword(ChangePasswordRequest $changePasswordRequest){

    }
    public function verifyResetPasswordCode(Request $request){

    }
    public function resendRegistrationCode(Request $request){

    }
}
