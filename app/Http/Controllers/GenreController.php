<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Song;
use App\Models\SongUser;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all()->sortBy('name');
        return view('genre.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $genres = Genre::all()->sortBy('name');
        $song = Song::findorfail($id);
        return view('genre.create', compact('genres', 'song'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $song = Song::findorfail($id);
        $selectedGenres = $request->input('genres', []);
        $song->genres()->sync($selectedGenres);
        $path = '/songs/' . $id;
        return redirect($path);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $genre = Genre::findorfail($id);
        $songUser = SongUser::all();
        return view('genre.show', compact('genre', 'songUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        //
    }
}
