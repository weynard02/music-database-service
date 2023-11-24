<?php

namespace App\Providers;

use App\Models\Song;
use App\Observers\SongObserver;
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
        Song::observe(SongObserver::class);
    }
}
