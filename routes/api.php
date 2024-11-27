<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Api\Controllers\UnitController;
// use App\Api\Controllers\SchoolController;
// use App\Api\Controllers\StudentController;
// use App\Api\Controllers\TeacherController;
// use App\Api\Controllers\OrganizationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    require base_path('routes/auth.php');

    // Route::middleware(['auth:sanctum', 'localization'])->group(function () {
    //     Route::resource('organization', OrganizationController::class);
    // });


    // Route::middleware(['auth:sanctum', 'localization'])->group(function () {
    //     Route::resource('schools', SchoolController::class);
    // });

    // Route::middleware(['auth:sanctum', 'localization'])->group(function () {
    //     Route::resource('teachers', TeacherController::class);
    // });

    // Route::middleware(['auth:sanctum', 'localization'])->group(function () {
    //     Route::resource('students', StudentController::class);
    // });

    // Route::middleware(['auth:sanctum', 'localization'])->group(function () {
    //     Route::resource('units', UnitController::class);
    // });
});