<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class AutoDeleteUnverifiedUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-delete-unverified-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::where('is_verified', 0)->delete();
    }
}
