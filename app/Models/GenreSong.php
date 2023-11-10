<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GenreSong extends Pivot
{
    protected $fillable = ['genre_id', 'song_id'];
}
