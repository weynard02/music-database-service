<?php

namespace App\Http\Module\Artist\Application\Services\CreateArtist;

class CreateArtistRequest
{
    public function __construct(
        public string $name,
        public string $description,
        public bool $is_verified,
    )
    {
    }
}
