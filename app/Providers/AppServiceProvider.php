<?php

namespace App\Providers;

use App\Models\Song;
use App\Observers\SongObserver;
use Illuminate\Support\Facades\Blade;
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
        Song::observe(SongObserver::class);

        // Register view namespaces
        foreach (scandir($path = app_path('Modules')) as $moduleDir) {
            View::addNamespace($moduleDir, "{$path}/{$moduleDir}/Presentation/views");
            Blade::componentNamespace("App\\Modules\\{$moduleDir}\\Presentation\\Components", $moduleDir);
        }

        // Timezone for Carbon\Carbon
        date_default_timezone_set('Asia/Aden');
    }
}
