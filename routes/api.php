<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Api\Controllers\SchoolController;
use App\Api\Controllers\TeacherController;
use App\Api\Controllers\PublishingHouseController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

require base_path('routes/auth.php');

Route::middleware(['auth:sanctum', 'localization'])->group(function () {
    Route::resource('publishing-house', PublishingHouseController::class);
});


Route::middleware(['auth:sanctum', 'localization'])->group(function () {
    Route::resource('schools', SchoolController::class);
});

Route::middleware(['auth:sanctum', 'localization'])->group(function () {
    Route::resource('teachers', TeacherController::class);
});