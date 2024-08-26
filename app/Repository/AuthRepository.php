<?php

namespace App\Repository;

use App\Api\Requests\AuthRequests\ChangePasswordRequest;
use App\Api\Requests\AuthRequests\ForgotPasswordRequest;
use App\Api\Requests\AuthRequests\LoginRequest;
use App\Api\Requests\AuthRequests\RegistrationRequest;
use App\Api\Requests\AuthRequests\ResetPasswordRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\EmailVerificationCode;
use App\Models\ResetPasswordCodeVerification;
use App\Models\User;
use App\Services\SendResetPasswordCodeService;
use App\Services\SendVerificationCodeService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthRepository implements AuthRepositoryInterface
{
    use ApiResponseTrait;
    public function __construct(private SendVerificationCodeService $sendVerificationCodeService ,
                                private SendResetPasswordCodeService $sendResetPasswordCodeService){}

    public function register(RegistrationRequest $registrationRequest){
        try {
            $validatedData = $registrationRequest->validated();
            $user = User::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'user_type_id' => $validatedData['user_type_id'],
                'gender' => $validatedData['gender'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
            ]);
            if ($user) {
                $this->sendVerificationCodeService->sendVerificationCode($user);
                $token = $user->createToken($registrationRequest->userAgent())->plainTextToken;
                $user['token'] = $token;
                return $this->successResponse(['user' =>$user],'User registered successfully.',200);
            }
        }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage(),500);
        }
    }
    public function login(LoginRequest $loginRequest){
        try {
            $credentials = $loginRequest->only(['email', 'password']);
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if (!$user->is_verified) {
                    $this->sendVerificationCodeService->sendVerificationCode($user);
                    return $this->errorResponse('Your email is not verified. A verification code has been sent to your email.', 403);
                }
                $token = $user->createToken($loginRequest->userAgent())->plainTextToken;
                $user['token'] = $token;
                return $this->successResponse(
                    ['user' =>$user],'Login successful.',200);
            }else{
                return $this->errorResponse('Invalid credentials',401);
            }
        }catch (\Exception $exception){
            return $this->errorResponse($exception->getMessage(),500);
        }
    }
    public function logout(Request $request){
        try{
            $user = Auth::user();
            $request->user()->currentAccessToken()->delete();
            return $this->successResponse(null,'Logged out successfully');
        } catch(\Exception $e){
            return $this->errorResponse(['message' => $e->getMessage()],500);
        }
    }
    public function profile()
    {
        try {
            $user = Auth::user();
            if (!$user){
                return    $this->errorResponse('Unauthenticated',401);
            }
            return  $this->successResponse(['user' => $user], 'User profile successfully.');
        }catch (\Exception $exception){
            return $this->errorResponse(['message'=>$exception->getMessage()],500);
        }
    }
    public function sendResetPasswordCode(Request $request){
        try {
        $validatedData = $request->validate([
            'email' => 'required|string|email|exists:users,email',
        ]);
            $user = User::where('email',$validatedData['email'])->first();
            if (!$user){
                return $this->errorResponse('User not found',401);
            }
            $this->sendResetPasswordCodeService->sendResetPasswordCode($user->email);
            return  $this->successResponse(null,'Reset password successfully.');
        }catch (ValidationException $exception){
            return $this->errorResponse($exception->getMessage(),422);
        }
        catch (\Exception $e){
            return $this->errorResponse($e->getMessage(),500);
        }
    }
    public function resetPassword(ResetPasswordRequest $resetPasswordRequest){
        try {
            $validated = $resetPasswordRequest->validated();
            $emailVerificationCode = ResetPasswordCodeVerification::where('email', $validated['email'])
                ->where('expired_at', '>=', now())
                ->first();

            if (!$emailVerificationCode) {
                return $this->errorResponse('Invalid Or Expired Code', 401);
            }

            $user = User::where('email', $validated['email'])->first();
            if (!$user) {
                return $this->errorResponse('User not found', 404);
            }
            $user->password = Hash::make($validated['password']);
            $user->save();
            $emailVerificationCode->delete();
            return $this->successResponse(null,'password_reset_successfully');
        }catch (ValidationException $exception){
            return $this->errorResponse($exception->getMessage(),422);
        }
        catch (\Exception $e){
            return $this->errorResponse($e->getMessage(),500);
        }
    }
    public function refreshToken(Request $request)
    {
        try {
            $user = Auth::user();
            $request->user()->currentAccessToken()->delete();
            $token = $user->createToken($request->userAgent())->plainTextToken;
            return $this->successResponse(['token' => $token], 'Token refreshed successfully.', 200);

        } catch (\Exception $e) {
            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
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
