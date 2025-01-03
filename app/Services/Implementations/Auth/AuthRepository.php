<?php

namespace App\Services\Implementations\Auth;

use App\Http\Requests\AuthRequests\ChangePasswordRequest;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\ResetPasswordRequest;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ResetPasswordCodeVerification;
use App\Services\SendVerificationCodeService;
use App\Services\SendResetPasswordCodeService;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AuthRequests\RegistrationRequest;
use App\Services\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    use ApiResponseTrait;
    public function __construct(
        private SendVerificationCodeService $sendVerificationCodeService,
        private SendResetPasswordCodeService $sendResetPasswordCodeService
    ) {
    }

    public function register(RegistrationRequest $registrationRequest)
    {
        try {
            $validatedData = $registrationRequest->validated();
            DB::beginTransaction();
            $user = User::create([
                'name_ar' => $validatedData['name_ar'],
                'name_en' => $validatedData['name_en'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'user_type' => $validatedData['user_type'],
                'gender' => $validatedData['gender'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
            ]);
            DB::commit();
            if ($user) {
                // $this->sendVerificationCodeService->sendVerificationCode($user);
                $token = $user->createToken($registrationRequest->userAgent())->plainTextToken;
                $user['token'] = $token;
                switch ($validatedData['user_type']) {
                    case 'student':
                        Student::create([
                            'user_id' => $user->id,
                        ]);
                        break;
                    case 'teacher':
                        Teacher::create([
                            'user_id' => $user->id,
                        ]);
                        break;
                    default:
                        break;
                }

                return $this->successResponse(['user' => new UserResource($user)], trans('messages.user_registered_successfully'));
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->errorResponse($exception->getMessage(), trans('messages.server_error'), 500);
        }
    }
    public function login(LoginRequest $loginRequest)
    {
        try {
            $credentials = $loginRequest->only(['email', 'password']);
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if (!$user->is_verified) {
                    $this->sendVerificationCodeService->sendVerificationCode($user);
                    return $this->errorResponse(null, trans('messages.email_not_verified'), 403);
                }
                $token = $user->createToken($loginRequest->userAgent())->plainTextToken;
                $user['token'] = $token;
                return $this->successResponse(
                    ['user' => $user],
                    trans('messages.login_successful'),
                    200
                );
            } else {
                return $this->errorResponse(null, trans('messages.invalid_credentials'), 401);
            }
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), trans('messages.server_error'), 500);
        }
    }
    public function logout(Request $request)
    {
        try {
            $user = Auth::user();
            $request->user()->currentAccessToken()->delete();
            return $this->successResponse(null, trans('messages.logged_out_successfully'));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), trans('messages.server_error'), 500);
        }
    }
    public function profile()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return $this->errorResponse(null, trans('messages.unauthenticated'), 401);
            }
            return $this->successResponse(['user' => $user], trans('messages.user_profile_successful'));
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), trans('messages.server_error'), 500);
        }
    }
    public function sendResetPasswordCode(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|string|email|exists:users,email',
            ]);
            $user = User::where('email', $validatedData['email'])->first();
            if (!$user) {
                return $this->errorResponse(null, trans('messages.user_not_found'), 401);
            }
            $this->sendResetPasswordCodeService->sendResetPasswordCode($user->email);
            return $this->successResponse(null, trans('messages.reset_password_code_sent'));
        } catch (ValidationException $exception) {
            return $this->errorResponse($exception->getMessage(), trans('messages.validation_error'), 422);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), trans('messages.server_error'), 500);
        }
    }
    public function resetPassword(ResetPasswordRequest $resetPasswordRequest)
    {
        try {
            $validated = $resetPasswordRequest->validated();
            $emailVerificationCode = ResetPasswordCodeVerification::where('email', $validated['email'])
                ->where('expired_at', '>=', now())
                ->first();

            if (!$emailVerificationCode) {
                return $this->errorResponse(null, trans('messages.invalid_or_expired_code'), 401);
            }

            $user = User::where('email', $validated['email'])->first();
            if (!$user) {
                return $this->errorResponse(null, trans('messages.user_not_found'), 404);
            }
            $user->password = Hash::make($validated['password']);
            $user->save();
            $emailVerificationCode->delete();
            return $this->successResponse(null, trans('messages.password_reset_successful'));
        } catch (ValidationException $exception) {
            return $this->errorResponse($exception->getMessage(), trans('messages.validation_error'), 422);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), trans('messages.server_error'), 500);
        }
    }
    public function refreshToken(Request $request)
    {
        try {
            $user = Auth::user();
            $request->user()->currentAccessToken()->delete();
            $token = $user->createToken($request->userAgent())->plainTextToken;
            return $this->successResponse(['token' => $token], trans('messages.token_refreshed_successfully'), 200);

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), trans('messages.server_error'), 500);
        }
    }

    public function verifyEmail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email|exists:users,email',
                'verification_code' => 'required|integer',
            ]);

            $email = $request->input('email');
            $verification_code = $request->input('verification_code');
            $user = User::where('email', $email)
                ->where('verification_code', $verification_code)
                ->first();
            if (!$user) {
                return $this->errorResponse(null, trans('messages.user_not_found'), 401);
            }
            if ($user->email_verified_at) {
                return $this->successResponse(null, trans('messages.email_already_verified'), 200);
            }
            $user->email_verified_at = now();
            $user->is_verified = true;
            $user->save();
            return $this->successResponse(null, trans('messages.email_verified_successfully'));
        } catch (ValidationException $e) {
            return $this->errorResponse($e->getMessage(), trans('messages.validation_error'), 422);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), trans('messages.server_error'), 500);
        }
    }
    public function changePassword(ChangePasswordRequest $changePasswordRequest)
    {
        try {
            $validated = $changePasswordRequest->validated();
            $user = Auth::user();
            if (!Hash::check($validated['current_password'], $user->password)) {
                return $this->errorResponse(null, __('messages.current_password_incorrect'), 400);
            }
            $user->password = Hash::make($validated['new_password']);
            $user->save();
            return $this->successResponse(null, __('messages.password_changed_successfully'));
        } catch (ValidationException $exception) {
            return $this->errorResponse($exception->getMessage(), trans('messages.validation_error'), 422);
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage(), ['trace' => $exception->getTraceAsString()]);
            return $this->errorResponse($exception->getMessage(), trans('messages.server_error'), 500);
        }

    }
    public function verifyResetPasswordCode(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|exists:reset_password_code_verification,email',
            'code' => 'required|integer',
        ]);

        try {
            $email = $validatedData['email'];
            $code = $validatedData['code'];

            $verificationRecord = ResetPasswordCodeVerification::where('email', $email)
                ->where('code', $code)
                ->first();

            if (!$verificationRecord) {
                return $this->errorResponse(null, trans('messages.user_not_found'), 401);
            }

            if ($verificationRecord->expired_at && Carbon::parse($verificationRecord->expired_at)->lt(now())) {
                return $this->errorResponse(null, trans('messages.invalid_or_expired_code'), 400);
            }

            return $this->successResponse(null, trans('messages.code_verified_successfully'));
        } catch (ValidationException $e) {
            return $this->errorResponse($e->getMessage(), trans('messages.validation_error'), 422);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), trans('messages.server_error'), 500);
        }
    }

    public function resendRegistrationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return $this->errorResponse(null, trans('messages.user_not_found'), 400);
            }
            $code = rand(10000, 99999);
            $user->update([
                'verification_code' => $code,
                'expired_at' => now()->addMinutes(30),
            ]);
            $this->sendVerificationCodeService->sendVerificationCode($user);
            return $this->successResponse(null, trans('messages.verification_code_resent'));
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), trans('messages.server_error'), 500);
        }
    }
}
