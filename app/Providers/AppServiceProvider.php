<?php

namespace App\Providers;

use App\Repository\UnitRepository;
use App\Repository\SchoolRepository;
use App\Repository\TeacherRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\OrganizationRepository;
use App\Interfaces\UnitRepositoryInterface;
use App\Interfaces\SchoolRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Interfaces\OrganizationRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
        $this->app->bind(SchoolRepositoryInterface::class, SchoolRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(UnitRepositoryInterface::class, UnitRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
