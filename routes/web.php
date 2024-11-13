<?php

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
    });
});