<?php

namespace App\Providers;

use App\Repository\TeacherRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\SchoolRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Repository\SchoolRepositoryRepository;
use App\Interfaces\OrganizationRepositoryInterface;
use App\Repository\OrganizationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
        $this->app->bind(SchoolRepositoryInterface::class, SchoolRepositoryRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
