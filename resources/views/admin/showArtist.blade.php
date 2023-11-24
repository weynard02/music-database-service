@extends('layouts.admin.master')

@section('content')
<div class="container my-4">
  <div class="row mx-4 p-4 justify-content-center">
    <div class="col-12">
        <div class="row mb-1">
            <p><span class="fw-bold">Name:</span> {{$artist->name}}</p> 
        </div>
        <div class="row mb-1">
            <p><span class="fw-bold">Description:</span> {{$artist->description}}</p> 
        </div>
        <form action="/admin/artists/delete/{{$artist->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('delete')
            <a href="/admin/artists/edit/{{$artist->id}}" class="btn btn-primary">Edit</a>
            <input type="submit" class="btn btn-danger" role="button" value="Delete"></a>
        </form>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
  </div>
</div>
@endsection