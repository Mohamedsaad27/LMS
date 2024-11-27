<?php

namespace App\Providers;

use App\Services\Implementations\Dashboard\Admin\GradeRepository;
use App\Services\Implementations\Dashboard\Admin\OrganizationRepository;
use App\Services\Implementations\Dashboard\Admin\SchoolRepository;
use App\Services\Implementations\Dashboard\Admin\StudentRepository;
use App\Services\Interfaces\Dashboard\Admin\GradeRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\OrganizationRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\SchoolRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\StudentRepositoryInterface;
use App\View\Components\Dashboard\LangeSwitcher;
use Illuminate\Support\ServiceProvider;
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
