<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('update:chart')->weekly();
        $schedule->command('app:auto-delete-unverified-user')->hourly();

        foreach (scandir($path = app_path('Modules')) as $dir) {
            if (file_exists($filepath = "{$path}/{$dir}/scheduling.php")) {
                require $filepath;
            }
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        foreach (scandir($path = app_path('Modules')) as $dir) {
            if (file_exists($folder_path = "{$path}/{$dir}/Presentation/Commands")) {
                $this->load($folder_path);
            }
        }

        require base_path('routes/console.php');
    }
}
