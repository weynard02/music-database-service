@extends('layouts.admin.master')

@section('content')
<div class="containter p-5">
    <form action="/admin/update/{{$song->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <h2>Edit song</h2>
        <div class="mb-3">
            <label for="title" class="form-label">Title Song <sup>*</sup></label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title..." value="{{ $song->title }}">
        </div>
        <div class="mb-3">
            <label for="artist" class="form-label">Artist <sup>*</sup></label>
            <input type="text" class="form-control" id="artist" name="artist" placeholder="Enter Artist..." value="{{ $song->artist->name }}">
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Release Date <sup>*</sup></label>
            <input type="date" class="form-control" id="release_date" name="release_date" value="{{ $song->release_date }}">
        </div>
        <div class="mb-3">
            <label for="audio" class="form-label">Audio File (Upload if you want to replace)</label>
            <input class="form-control" type="file" id="audio" name="audio" value="{{ $song->file_audio_path }}">
        </div>
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail (Upload if you want to replace)</label>
            <input class="form-control" type="file" id="thumbnail" name="thumbnail" value="{{ $song->thumbnail_path }}">
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <textarea class="form-control" id="tags" rows="3" name="tags" placeholder="Max 255 charaters">{{$song->tags}}</textarea>
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('artist')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('release_date')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('audio')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('thumbnail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('tags')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="./" class="btn btn-danger">&lt; Back</a>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection