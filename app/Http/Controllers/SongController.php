<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form');
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

        Song::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'release_date' => $request->release_date,
            'file_audio_path' => $audioPath,
            'thumbnail_path' => $thumbnailPath,
            'tags' => $request->tags
        ]);

        return redirect('/form');

    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        //
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
