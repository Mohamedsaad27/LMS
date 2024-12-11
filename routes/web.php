<?php

use App\Models\School;
use App\Models\Student;
use App\Models\Organization;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Dashboard\Admin\RoleController;
use App\Http\Controllers\Web\Dashboard\Admin\UserController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Web\Dashboard\Admin\GradeController;
use App\Http\Controllers\Web\Dashboard\Admin\SchoolController;
use App\Http\Controllers\Web\Dashboard\Admin\StudentController;
use App\Http\Controllers\Web\Dashboard\Admin\SubjectController;
use App\Http\Controllers\Web\Dashboard\Admin\TeacherController;
use App\Http\Controllers\Web\Dashboard\Admin\OrganizationController;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    /*
     * |--------------------------------------------------------------------------
     * | DASHBOARD ROUTES
     * |--------------------------------------------------------------------------
     * | These routes handle all the DASHBOARD views and functionalities accessible
     * | by users or guests. They manage the user interface, site navigation, and
     * | public-facing content.
     * |--------------------------------------------------------------------------
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

        // -------------------------- User Route -------------------------------- //
        Route::resource('users', UserController::class);

        // -------------------------- Roles Routes -------------------------------- //
        Route::resource('roles', RoleController::class);

        // -------------------------- Teacher Route -------------------------------- //
        Route::resource('teachers', TeacherController::class);

        // -------------------------- Subjects Route -------------------------------- //
        Route::resource('subjects', SubjectController::class);
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
