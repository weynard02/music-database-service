@extends('layouts.admin.master')

@section('content')
<div class="container my-4">
  @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <div class="row row-cols-1 row-cols-md-2 g-4">
    @foreach($users as $i)
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $i->name }}</h5>
          <p class="card-text">{{ $i->email}} <small class="text-body-secondary">{{ $i->plan->name }}</small></p>
          <a href="#" class="btn btn-primary">Show</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection