<?php

use App\Api\Controllers\PublishingHouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

require base_path('routes/auth.php');

Route::middleware(['auth:sanctum', 'localization'])->group(function () {
    Route::resource('publishing-house', PublishingHouseController::class);
});


