<?php

namespace App\Observers;

use App\Models\Song;
use Illuminate\Support\Facades\Cache;

class SongObserver
{
    public function clearCache() {
        $len = Song::all()->count();
        $pages = $len / 20 + 1;
        for ($i = 1; $i <= $pages; $i++) {
            $key = 'songs-page-'.$i;
            if (Cache::has($key)) {
                Cache::forget($key);
            }
            else {
                break;
            }
        }
    }
    
    /**
     * Handle the Song "created" event.
     */
    public function created(Song $song): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Song "updated" event.
     */
    public function updated(Song $song): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Song "deleted" event.
     */
    public function deleted(Song $song): void
    {
        $this->clearCache();
    }
}
