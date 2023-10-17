<?php

namespace App\Http\Module\Artist\Infrastructure\Repository;

use App\Http\Module\Artist\Domain\Model\Artist;
use App\Http\Module\Artist\Domain\Services\Repository\ArtistRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ArtistRepository implements ArtistRepositoryInterface
{
    public function save(Artist $artist)
    {
        DB::table('artists')->upsert(
            [
                'name' => $artist->name,
                'description' => $artist->description,
                'is_verified' => $artist->is_verified,
            ],'name'
        );
    }
}
