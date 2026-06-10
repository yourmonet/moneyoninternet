<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\PembayaranKas;
use App\Observers\PembayaranKasObserver;

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
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
        PembayaranKas::observe(PembayaranKasObserver::class);
    }
}
