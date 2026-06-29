<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Tambahkan ini di atas

public function boot()
{
    // Paksa penggunaan HTTPS jika aplikasi berjalan di lingkungan produksi (seperti Railway)
    if ($this->app->environment('production')) {
        URL::forceScheme('https');
    }
}

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
        //
    }
}
