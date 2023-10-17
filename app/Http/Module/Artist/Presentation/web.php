<?php

Route::post('create_artist', [\App\Http\Module\Artist\Presentation\Controller\ArtistController::class, 'createArtist']);