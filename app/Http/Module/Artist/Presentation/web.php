<?php
use Illuminate\Support\Facades\Route;

Route::get('ping', function(){
    return csrf_token();
});

Route::post('create_artist', [\App\Http\Module\Artist\Presentation\Controller\ArtistController::class, 'createArtist']);