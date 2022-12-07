<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\LINE\LoginRepositoryInterface::class,
            \App\Repositories\LINE\LoginRepository::class,
        );
        $this->app->bind(
            \App\Repositories\LINE\LineMessengerRepositoryInterface::class,
            \App\Repositories\LINE\LineMessengerRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
