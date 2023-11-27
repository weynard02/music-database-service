<?php

namespace App\Observers;

use App\Models\Artist;
use Illuminate\Support\Facades\Cache;

class ArtistObserver
{
    public function clearCache() {
        $len = Artist::all()->count();
        $pages = $len / 10 + 1;
        for ($i = 1; $i <= $pages; $i++) {
            $key = 'artists-page-'.$i;
            if (Cache::has($key)) {
                Cache::forget($key);
            }
            else {
                break;
            }
        }
    }
    
    /**
     * Handle the Artist "created" event.
     */
    public function created(Artist $artist): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Artist "updated" event.
     */
    public function updated(Artist $artist): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Artist "deleted" event.
     */
    public function deleted(Artist $artist): void
    {
        $this->clearCache();
    }
}
