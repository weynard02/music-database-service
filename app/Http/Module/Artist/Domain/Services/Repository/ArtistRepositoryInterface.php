<?php

namespace App\Http\Module\Artist\Domain\Services\Repository;

use App\Http\Module\Artist\Domain\Model\Artist;

interface ArtistRepositoryInterface
{
    public function save(Artist $artist);
}

?>