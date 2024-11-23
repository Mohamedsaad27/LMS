<?php

namespace App\Providers;

use App\Interfaces\GradeRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\SchoolRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Repository\Dashboard\SchoolRepository;
use App\Repository\Dashboard\StudentRepository;
use App\Interfaces\OrganizationRepositoryInterface;
use App\Repository\Dashboard\GradeRepository;
use App\Repository\Dashboard\OrganizationRepository;
use App\View\Components\LangeSwitcher;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Rigester Rebository
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
        $this->app->bind(SchoolRepositoryInterface::class, SchoolRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(GradeRepositoryInterface::class, GradeRepository::class);

        // Rigester Commponents
        Blade::component('lang-switcher', LangeSwitcher::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
