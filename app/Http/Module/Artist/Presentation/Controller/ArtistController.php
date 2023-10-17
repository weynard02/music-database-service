<?php

namespace App\Http\Module\Artist\Presentation\Controller;

use App\Http\Module\Artist\Application\Services\CreateArtist\CreateArtistRequest;
use App\Http\Module\Artist\Application\Services\CreateArtist\CreateArtistService;
use Illuminate\Support\Facades\Request;

class ArtistController
{
    public function __construct(
        private CreateArtistService $create_artist_service
    )
    {
    }

    public function createArtist(Request $request){
        $request = new CreateArtistRequest(
            $request->input('name'),
            $request->input('description'),
            $request->input('is_verified'),
        );

        return $this->create_artist_service->execute($request);
    }
}
