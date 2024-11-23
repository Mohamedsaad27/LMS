<?php

use App\Http\Controllers\Dashboard\GradeController;
use App\Models\School;
use App\Models\Student;
use App\Models\Organization;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\SchoolController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Dashboard\OrganizationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

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
            $schools = School::all();
            $organizations = Organization::all();
            $students = Student::all();
            return view('dashboard.index', compact('schools', 'organizations', 'students'));
        })->name('admin.dashboard');

        // -------------------------- Organization Route -------------------------------- //
        Route::resource('organizations', OrganizationController::class);

        // -------------------------- School Route -------------------------------- //
        Route::resource('schools', SchoolController::class);

        // -------------------------- Student Route -------------------------------- //
        Route::resource('students', StudentController::class);

        // -------------------------- Grade Route -------------------------------- //
        Route::resource('grades', GradeController::class);
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
