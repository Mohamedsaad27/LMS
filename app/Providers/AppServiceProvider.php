<?php

namespace App\Providers;

use App\Interfaces\PublishingHouseInterface;
use App\Interfaces\SchoolInterface;
use App\Repository\PublishingHouseRepository;
use App\Repository\SchoolRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PublishingHouseInterface::class, PublishingHouseRepository::class);
        $this->app->bind(SchoolInterface::class, SchoolRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
