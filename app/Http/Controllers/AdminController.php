<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminHome() {
        return view('admin.dashboard');
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $songs = Song::all();
        return view('admin.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
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

        return redirect('/admin/songs')->with('success', 'Input successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $song = Song::findorfail($id);
        return view('admin.show', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $song = Song::findorfail($id);
        return view('admin.edit', compact('song'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'artist' => 'required|max:255',
            'release_date' => 'required',
            'audio' => 'mimes:mp3',
            'thumbnail' => 'mimes:jpg,png,jpeg',
            'tags' => 'max:255'
        ]);

        $song = Song::findorfail($id);
        $audioPath = $song->file_audio_path;
        if ($request->audio) {
            Storage::delete('public/songs/'.$song->file_audio_path);
            $audioPath = $request->audio->getClientOriginalName();
            $request->audio->storeAs('public/songs', $audioPath);
        }
        
        $thumbnailPath = $song->thumbnail_path;
        if ($request->thumbnail) {
            Storage::delete('public/thumbnails/'.$song->thumbnail_path);
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

        $song->update([
            'title' => $request->title,
            'release_date' => $request->release_date,
            'file_audio_path' => $audioPath,
            'thumbnail_path' => $thumbnailPath,
            'tags' => $request->tags,
            'artist_id' => $artistId,
        ]);

        return redirect('/admin/songs')->with('success', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $song = Song::findorfail($id);
        Storage::delete('public/songs/'.$song->file_audio_path);
        Storage::delete('public/thumbnails/'.$song->thumbnail_path);
        $song->delete();
        return redirect('/admin/songs')->with('success', 'Delete successfully!');
    }   
}
