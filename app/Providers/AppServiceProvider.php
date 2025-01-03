<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\View\Components\Dashboard\LangeSwitcher;
use App\Services\Implementations\Dashboard\Admin\BookRepository;
use App\Services\Implementations\Dashboard\Admin\RoleRepository;
use App\Services\Implementations\Dashboard\Admin\UnitRepository;
use App\Services\Implementations\Dashboard\Admin\UserRepository;
use App\Services\Implementations\Dashboard\Admin\ClassRoomRepository;
use App\Services\Implementations\Dashboard\Admin\GradeRepository;
use App\Services\Implementations\Dashboard\Admin\LessonRepository;
use App\Services\Implementations\Dashboard\Admin\SchoolRepository;
use App\Services\Implementations\Dashboard\Admin\StudentRepository;
use App\Services\Implementations\Dashboard\Admin\SubjectRepository;
use App\Services\Implementations\Dashboard\Admin\TeacherRepository;
use App\Services\Interfaces\Dashboard\Admin\BookRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\RoleRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\UnitRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\UserRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\GradeRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\LessonRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\SchoolRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\StudentRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\SubjectRepositoryInterface;
use App\Services\Interfaces\Dashboard\Admin\TeacherRepositoryInterface;
use App\Services\Implementations\Dashboard\Admin\OrganizationRepository;
use App\Services\Interfaces\Dashboard\Admin\ClassRoomRepositoryInterface;
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
        $this->app->bind(UnitRepositoryInterface::class, UnitRepository::class);
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(ClassRoomRepositoryInterface::class, ClassRoomRepository::class);
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
