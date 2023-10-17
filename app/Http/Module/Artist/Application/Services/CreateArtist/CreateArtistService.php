<?php

namespace App\Http\Module\Artist\Application\Services\CreateArtist;

use App\Http\Module\Artist\Domain\Model\Artist;
use App\Http\Module\Artist\Infrastructure\Repository\ArtistRepository;

class CreateArtistService
{

    public function __construct(
        private ArtistRepository $artist_repository
    )
    {
    }

    public function execute(CreateArtistRequest $request){
        $artist = new Artist(
            $request->name,
            $request->description,
            $request->is_verified,
        );

        $this->artist_repository->save($artist);
    }
}
