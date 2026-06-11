<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- Tambahkan ini di atas

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
        // FIX TAMPILAN HANCUR DI RAILWAY: Paksa Laravel pakai HTTPS
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
