<?php

namespace App\Providers;

use App\Interfaces\PublishingHouseInterface;
use App\Repository\PublishingHouseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PublishingHouseInterface::class, PublishingHouseRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
