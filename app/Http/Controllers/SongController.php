<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\SongUser;
use App\Providers\SetFavouriteSong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    public function dashboard() {
        $popularChart = Song::all()->sortByDesc('streams')->take(10);
        $newSongs = Song::all()->sortByDesc('release_date')->take(10);
        $randomPlaylist = Playlist::where('is_public', '1')->inRandomOrder()->first();

        return view('dashboard', compact('popularChart', 'newSongs', 'randomPlaylist'));
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->song) {
            $songs = Song::select('songs.*')
            ->join('artists', 'artists.id', '=', 'songs.artist_id')
            ->where('tags', 'LIKE', '%'.$request->song.'%')
            ->orWhere('title', 'LIKE', '%'.$request->song.'%')
            ->orWhere('artists.name', 'LIKE', '%'.$request->song.'%')
            ->paginate(20);
            $songUser = SongUser::all();
            return view('discover', compact('songs', 'songUser'));  
        }

        $ttl = 60*60;
        $songs = Cache::remember('songs-page-' . request('page', 1), $ttl, function () {
            return Song::orderBy('release_date', 'desc')->paginate(20);
        });

        $songUser = SongUser::all();
        return view('discover', compact('songs', 'songUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'artist' => 'required|max:255',
            'release_date' => 'required',
            'audio' => 'required|mimes:mp3',
            'thumbnail' => 'mimes:jpg,png,jpeg',
            'tags' => 'max:255'
        ]);

        $audioPath = $request->audio->getClientOriginalName();
        $request->audio->storeAs('public/songs', $audioPath);

        $thumbnailPath = null;
        if ($request->thumbnail) {
            $thumbnailPath = $request->thumbnail->getClientOriginalName();
            $request->thumbnail->storeAs('public/thumbnails', $thumbnailPath);
        }

        if(!Artist::firstWhere('name', $request->artist)) {
            Artist::create([
                'name' => $request->artist,
                'description' => 'TBA',
                'is_verified' => false
            ]);
        }

        $artistId = Artist::firstWhere('name', $request->artist)->id;

        Song::create([
            'title' => $request->title,
            'release_date' => $request->release_date,
            'file_audio_path' => $audioPath,
            'thumbnail_path' => $thumbnailPath,
            'tags' => $request->tags,
            'artist_id' => $artistId,
        ]);

        return redirect('/songs')->with('success', 'Input successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $song = Song::findorfail($id);
        $song->increment('streams');
        return view('song', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update Favorite
     */
    public function setFavorite(Request $request) {
        $user = Auth::user();
        $song = Song::findOrFail($request->id);
    
        $songUser = SongUser::where('user_id', $user->id)
            ->where('song_id', $song->id)
            ->first();
    
        if ($songUser) {
            $value = $songUser->is_favourite == 1 ? 0 : 1;
    
            // Update the 'is_favourite' column with the new value
            $songUser->where('user_id', $user->id)
            ->where('song_id', $song->id)->update([
                'is_favourite' => $value
            ]);
            SetFavouriteSong::dispatch($song, $user, $value);
            return redirect()->back();
        }
    
        // If the record doesn't exist, create a new one
        SongUser::create([
            'user_id' => $user->id,
            'song_id' => $song->id,
            'is_favourite' => true,
        ]);
        

        SetFavouriteSong::dispatch($song, $user, 1);
        return redirect('/songs');
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        //
    }
}
