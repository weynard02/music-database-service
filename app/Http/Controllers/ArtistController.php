<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->artist) {
            $artists = Artist::where("name", "LIKE", "%".$request->artist."%")->paginate(10);
            return view("artist.index", compact('artists'));
        }
        
        $ttl = 60*60;
        $artists = Cache::remember('artists-page-' . request('page', 1), $ttl, function() {
            return Artist::orderBy('name')->paginate(10);
        });
        
        return view('artist.index', compact('artists'));


    }

    public function indexAdmin() {
        $artists = Artist::all()->sortBy('name');
        return view('admin.artists', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $artist = Artist::findorfail($id);
        return view('artist.show', compact('artist'));
    }

    public function showAdmin($id) {
        $artist = Artist::findorfail($id);
        return view('admin.showArtist', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $artist = Artist::findorfail($id);
        return view('admin.artistEdit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1024'
        ]);

        $artist = Artist::findorfail($id);
        $artist->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect('/admin/artists')->with('success', 'Edit Artist Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $artist = Artist::findorfail($id);
        try {
            $artist->delete();
            return redirect('/admin/artists')->with('success', 'Delete successfully!');
        }
        catch (QueryException $e) {
            if($e->errorInfo[1] === 1451) {
                return redirect()->back()->with('error', 'This Artist has a song records, it cannot be deleted');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        }
    }
}
