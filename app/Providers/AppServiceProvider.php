<?php

namespace App\Providers;

use App\Services\PlatformStatusService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Compartilha o status operacional da plataforma externa com todas as views do portal
        View::composer('layouts.app', function ($view) {
            $view->with('platformStatus', PlatformStatusService::getStatusData());
        });
    }
}
