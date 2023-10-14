<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Playlist extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id'];

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
