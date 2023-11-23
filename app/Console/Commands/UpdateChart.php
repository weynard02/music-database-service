<?php

namespace App\Console\Commands;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\SongUser;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $uid = User::where("name", 'admin')->first()->id;
        $newPlaylist = Playlist::create([
            'name' => $name,
            'user_id' => $uid,
            'type' => 'Chart',
            'is_public' => true
        ]);
        $pid = $newPlaylist->id;

        // berdasarkan jumlah love
        $songs = SongUser::select('song_id', DB::raw('count(*) as count'))
        ->where('is_favourite', true)
        ->groupBy('song_id')
        ->orderBy('count', 'desc') 
        ->limit(100)->get();

        // dd($songs);
        // daftarkan lagu tersebut ke playlist
        foreach ($songs as $song) {
            PlaylistSong::create([
                'song_id'=> $song->song_id,
                'playlist_id' => $pid,
                'points' => $song->count
            ]);
        }
    }
}
