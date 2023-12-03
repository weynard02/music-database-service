<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\SongUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProcessCreateChart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $name
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $name = $this->name;
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
