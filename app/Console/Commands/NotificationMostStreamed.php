<?php

namespace App\Console\Commands;

use App\Mail\MostStreamedSong;
use App\Models\Song;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotificationMostStreamed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'most:streamed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Showing most streamed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        
        $song = Song::orderBy('streams', 'desc')->first();

        foreach($users as $user) {
            $user->notify(new \App\Notifications\MostStreamedSong($song));
        }
    }
}
