<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->playlist) {
            $playlists = Playlist::where("name", "LIKE", '%'. $request->playlist .'%')
            ->where("user_id", auth()->user()->id)->orderBy("created_at","desc")->paginate(10);
            return view('playlist.index', compact('playlists'));  
        }
        $playlists = Playlist::where("user_id", auth()->user()->id)->orderBy("created_at","desc")->paginate(10);
        return view('playlist.index', compact('playlists'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $songs = Song::all()->sortBy('title');
        return view('playlist.create', compact('songs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'songs.*' => 'required|exists:songs,id'
        ], [
            'songs.*' => 'Select song required!'
        ]);

        $playlist = Playlist::create([
            'name'=> $request->name,
            'type'=> $request->type,
            'user_id' => auth()->user()->id
        ]);

        $playlist->songs()->attach($request->songs);
        return redirect('/playlists')->with('success','Playlist created!');

    }

    public function storePivot(Request $request, $id) {
        $request->validate([
            'songs.*' => 'required|exists:songs,id'
        ], [
            'songs.*' => 'Select song required!'
        ]);
        $playlist = Playlist::findorfail($id);
        $playlist->songs()->attach($request->songs);
        return redirect('/playlists/'.$id)->with('success','Add success!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $playlist = Playlist::findorfail($id);
        $songs = Song::all()->sortBy('title'); 
        return view('playlist.show', compact('playlist', 'songs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        //
    }

    public function destroyPivot($playlistId, $songId) {
        PlaylistSong::where('playlist_id', $playlistId)
        ->where('song_id', $songId)->delete();


        return redirect('/playlists/'.$playlistId)->with('success','Delete Success!');
    }
}
