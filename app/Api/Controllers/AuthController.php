<?php

namespace App\Api\Controllers;

use App\Api\Requests\AuthRequests\LoginRequest;
use App\Api\Requests\AuthRequests\RegistrationRequest;
use App\Api\Requests\AuthRequests\ResetPasswordRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\AuthRepositoryInterface;
use App\Repository\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authRepository;
    public function __construct(AuthRepositoryInterface $authRepository){
        $this->authRepository = $authRepository;
    }
    public function register(RegistrationRequest $request)
    {
        return $this->authRepository->register($request);
    }
    public function login(LoginRequest $request)
    {
        return $this->authRepository->login($request);
    }
    public function logout(Request $request)
    {
        return $this->authRepository->logout($request);
    }
    public function refreshToken(Request $request)
    {
        return $this->authRepository->refreshToken($request);
    }
    public function profile(){
        return $this->authRepository->profile();
    }
    public function sendResetPasswordCode(Request $request){
        return $this->authRepository->sendResetPasswordCode($request);
    }
    public function resetPassword(ResetPasswordRequest $resetPasswordRequest){
        return $this->authRepository->sendResetPasswordCode($resetPasswordRequest);
    }
}
