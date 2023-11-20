@extends('layouts.admin.master')

@section('content')
<div class="container my-4">
  <div class="row mx-4 p-4 justify-content-center">
    <div class="col-12">
        <div class="row mb-1">
            <p><span class="fw-bold">Username:</span> {{$user->name}}</p> 
        </div>
        <div class="row mb-1">
            <p><span class="fw-bold">Email:</span> {{$user->email}}</p> 
        </div>
        <div class="row mb-1">
            <p><span class="fw-bold">Plan:</span> {{$user->plan->name}}</p> 
        </div>
        <form action="/admin/users/delete/{{$user->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger" role="button" value="Delete"></a>
        </form>
    </div>
  </div>
</div>
@endsection