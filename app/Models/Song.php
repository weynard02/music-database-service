<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Song extends Model
{
    use HasFactory;

    protected $table = 'songs';
    protected $primaryKey = 'id';

    protected $fillable = ['title', 'release_date','file_audio_path', 'thumbnail_path', 'tags'];

    public function artist(): BelongsTo 
    {
        return $this->belongsTo(Artist::class);
    }
}
