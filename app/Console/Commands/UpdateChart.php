<?php

namespace App\Console\Commands;

use App\Jobs\ProcessCreateChart;
use Illuminate\Console\Command;


class UpdateChart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:chart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Chart every week';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = "SpotinFly Chart ". date("Y-m-d");
        ProcessCreateChart::dispatchSync($name);
    }
}
