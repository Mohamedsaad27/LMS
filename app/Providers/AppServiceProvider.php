<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Interfaces\SchoolRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Repository\Dashboard\SchoolRepository;
use App\Repository\Dashboard\StudentRepository;
use App\Interfaces\OrganizationRepositoryInterface;
use App\Repository\Dashboard\OrganizationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrganizationRepositoryInterface::class,OrganizationRepository::class);
        $this->app->bind(SchoolRepositoryInterface::class,SchoolRepository::class);
        $this->app->bind(StudentRepositoryInterface::class,StudentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
