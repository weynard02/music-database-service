@extends('master')

@section('content')
    <form action="/submit" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Song Form</h2>
        <div class="mb-3">
            <label for="title" class="form-label">Title Song <sup>*</sup></label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title..." value="{{ old('title') }}">
        </div>
        <div class="mb-3">
            <label for="artist" class="form-label">Artist <sup>*</sup></label>
            <input type="text" class="form-control" id="artist" name="artist" placeholder="Enter Artist..." value="{{ old('artist') }}">
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Release Date <sup>*</sup></label>
            <input type="date" class="form-control" id="release_date" name="release_date" value="{{ old('release_date') }}">
        </div>
        <div class="mb-3">
            <label for="audio" class="form-label">Audio File <sup>*</sup></label>
            <input class="form-control" type="file" id="audio" name="audio" value="{{ old('audio') }}">
          </div>
          <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail</label>
            <input class="form-control" type="file" id="thumbnail" name="thumbnail" value="{{ old('thumbnail') }}">
          </div>
          <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <textarea class="form-control" id="tags" rows="3" name="tags" placeholder="Max 255 charaters" value="{{ old('tags') }}"></textarea>
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

        <a href="/" class="btn btn-danger">&lt; Back</a>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection