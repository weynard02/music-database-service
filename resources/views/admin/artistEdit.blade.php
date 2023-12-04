@extends('layouts.admin.master')

@section('content')
<div class="containter p-5">
    <form action="/admin/artists/{{$artist->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <h2>Edit Artist</h2>
        <div class="mb-3">
            <label for="name" class="form-label">Name <sup>*</sup></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name..." value="{{ $artist->name }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description <sup>*</sup></label>
            <textarea class="form-control" id="description" rows="3" name="description" placeholder="Max 1024 charaters">{{ $artist->description }}</textarea>
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="/admin/artists" class="btn btn-danger">&lt; Back</a>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection