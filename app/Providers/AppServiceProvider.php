<?php

namespace App\Providers;

use Carbon\Carbon;
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

        // parse date Carbon
        Carbon::macro('parseDate', function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
    }
}
