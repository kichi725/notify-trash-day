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
            \App\Repositories\LINE\MessengerRepositoryInterface::class,
            \App\Repositories\LINE\MessengerRepository::class,
        );

        $this->app->bind(
            \App\Services\MessengerInterface::class,
            function ($app) {
                if ($app->request->message === 'quick') {
                    return new \App\Services\Reply\QuickReply();
                }
                if ($app->request->message === 'text') {
                    return new \App\Services\Reply\TextReply();
                }
                dd($app->request->message);
            },
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
