<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use App\Models\SongUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->playlist) {
            if ($request->public) {
                $playlists = Playlist::where("name", "LIKE", '%'. $request->playlist .'%')
                ->where('is_public', 1)
                ->orderBy("created_at","desc")->paginate(10);
                return view('playlist.index', compact('playlists'));
            }
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
        if (Gate::allows('playlist-create-free')) return redirect()->back();
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
            'songs.*' => 'required|exists:songs,id',
            'type' => 'required',

        ], [
            'songs.*' => 'Select song required!'
        ]);

        $is_public = false;
        if ($request->public) $is_public = true;

        $playlist = Playlist::create([
            'name'=> $request->name,
            'type'=> $request->type,
            'is_public'=> $is_public,
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

        if(!$playlist->is_public && $playlist->user_id != Auth::user()->id)
            return redirect()->back();

        // songs untuk menselect lagi
        $songs = Song::all()->sortBy('title'); 
        if ($playlist->type == 'Chart') {
            $playlistSong = PlaylistSong::where('playlist_id', $id)->get();
            return view('playlist.chart', compact('playlist', 'songs', 'playlistSong'));
        }
        if ($playlist->type == 'Favourites') {
            return view('playlist.fav', compact('playlist', 'songs'));
        }
        return view('playlist.show', compact('playlist', 'songs'));
    }

    public function song($playlistId, $songId) {
        $playlist = Playlist::findorfail($playlistId);
        $song = Song::findorfail($songId);
        $playlistSong = PlaylistSong::where('playlist_id', $playlistId)
        ->where('song_id', $songId)->first();

        $nowOrder = $playlistSong->order;
        $nextSong = Song::select('songs.*')
        ->join('playlist_song', 'songs.id', '=', 'playlist_song.song_id')
        ->join('playlists', 'playlist_song.playlist_id', '=',  'playlists.id')
        ->where('playlists.id', $playlistId)
        ->where('order', '>', $nowOrder)
        ->first();

        $prevSong = Song::select('songs.*')
        ->join('playlist_song', 'songs.id', '=', 'playlist_song.song_id')
        ->join('playlists', 'playlist_song.playlist_id', '=',  'playlists.id')
        ->where('playlists.id', $playlistId)
        ->where('order', '<', $nowOrder)
        ->orderBy('order', 'desc')
        ->first();

        if(!$playlist->is_public && $playlist->user_id != Auth::user()->id)
            return redirect()->back();
        $song->increment('streams');
        return view('playlist.song', compact('song', 'playlist', 'nextSong', 'prevSong'));    
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
    public function destroy($id)
    {
        $playlist = Playlist::findorfail($id);
        $playlist->delete();

        return redirect('/playlists')->with('success', 'Delete Playlist Successfully');
    }

    public function destroyPivot($playlistId, $songId) {
        PlaylistSong::where('playlist_id', $playlistId)
        ->where('song_id', $songId)->delete();


        return redirect('/playlists/'.$playlistId)->with('success','Delete Success!');
    }
}
