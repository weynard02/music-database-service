<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SongUser extends Pivot
{
    //
    protected $fillable = ['song_id', 'user_id', 'is_favourite', 'voted'];
}
