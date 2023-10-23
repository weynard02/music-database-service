@extends('layouts.admin.master')

@section('content')
<div class="container my-4">
  <div class="row mx-4 p-4 justify-content-center">
    <div class="col-6">
        @if ($song->thumbnail_path)
            <img src="{{ asset('storage/thumbnails/' . $song->thumbnail_path) }}" class="rounded-t-lg" alt="Thumbnail not uploaded" width="75%">
        @else
            <img src="{{ asset('default_thumbnail.jpeg') }}" class="rounded-t-lg" width="75%">
        @endif
        
    </div>
    <div class="col-6">
        <div class="row mb-1">
            <p><span class="fw-bold">Title:</span> {{$song->title}}</p> 
        </div>
        <div class="row mb-1">
            <p><span class="fw-bold">Artist:</span> {{$song->artist->name}}</p> 
        </div>
        <div class="row mb-1">
            <p><span class="fw-bold">Release Date:</span> {{$song->release_date}}</p> 
        </div>
        <div class="row mb-1">
            <audio controls style="width: 100%; max-width: 600px">
                <source src="{{ asset('storage/songs/'. $song->file_audio_path)}}" type="audio/mpeg">
            Your browser does not support the audio element.
            </audio>
        </div>
        <div class="row mb-1">
            <p><span class="fw-bold">Tags:</span> {{$song->tags}}</p> 
        </div>
        <form action="/admin/delete/{{$song->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('delete')
            <a class="btn btn-primary" href="{{ route('admin.edit', ['id' => $song->id]) }}" role="button">Edit</a>
            <input type="submit" class="btn btn-danger" role="button" value="Delete"></a>
        </form>
    </div>
  </div>
</div>
@endsection