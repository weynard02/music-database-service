<?php

namespace App\Providers;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Providers\SetFavouriteSong;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class StoreFavouriteSong
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }


    public function addSong($song, $favPlaylist) {
        PlaylistSong::create([
            'playlist_id' => $favPlaylist->id,
            'song_id' => $song->id
        ]);
    }

    public function deleteSong($song, $favPlaylist) {
        PlaylistSong::where('playlist_id', $favPlaylist->id)
            ->where('song_id', $song->id)
            ->delete();
    }
    /**
     * Handle the event.
     */
    public function handle(SetFavouriteSong $event): void
    {
        $user = $event->user;
        $song = $event->song;
        $status = $event->isFav;

        $favPlaylist = Playlist::where('user_id', $user->id)
        ->where('name', 'Favourites')
        ->first();

        if (!$favPlaylist) {
            $favPlaylist = Playlist::create([
                'name' => 'Favourites',
                'user_id' => $user->id,
                'type' => 'Favourites',
                'is_public' => false
            ]);
        }


        if ($status == 0) {
            $this->deleteSong($song, $favPlaylist);
        }
        else {
            $this->addSong($song, $favPlaylist);
        }


    }
}
