<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/*
    |--------------------------------------------------------------------------
    | DASHBOARD ROUTES
    |--------------------------------------------------------------------------
    | These routes handle all the DASHBOARD views and functionalities accessible
    | by users or guests. They manage the user interface, site navigation, and
    | public-facing content.
    |--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin'], function () {

    // ------------------------------ DASHBOARD ROUTE ------------------------------ //
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('admin.dashboard');

    // -------------------------- Organization Route -------------------------------- //
    Route::resource('organizations', OrganizationController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
