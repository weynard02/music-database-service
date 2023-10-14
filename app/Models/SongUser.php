<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SongUser extends Pivot
{
    //
    protected $fillable = ['is_favourite', 'rate'];
}
