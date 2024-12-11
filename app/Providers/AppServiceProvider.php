<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Dashboard\LangeSwitcher;
use App\Services\Implementations\Dashboard\Admin\RoleRepository;
use App\Services\Implementations\Dashboard\Admin\UserRepository;
use App\Services\Implementations\Dashboard\Admin\GradeRepository;
use App\Services\Implementations\Dashboard\Admin\SchoolRepository;
use App\Services\Implementations\Dashboard\Admin\StudentRepository;
use App\Services\Implementations\Dashboard\Admin\SubjectRepository;
use App\Services\Implementations\Dashboard\Admin\TeacherRepository;
use App\Services\Interfaces\Dashboard\Admin\RoleRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\UserRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\GradeRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\SchoolRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\StudentRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\SubjectRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\TeacherRepositoryInterface;
use App\Services\Implementations\Dashboard\Admin\OrganizationRepository;
use App\Services\Interfaces\Dashboard\Admin\OrganizationRepositoryInterface;

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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class, SubjectRepository::class);

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
