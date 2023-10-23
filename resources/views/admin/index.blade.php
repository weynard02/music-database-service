@extends('layouts.admin.master')

@section('content')
<div class="container my-4">
  @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <div class="row row-cols-1 row-cols-md-2 g-4">
    @foreach($songs as $s)
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $s->artist->name }} - {{ $s->title }}</h5>
          <p class="card-text"><small class="text-body-secondary">{{ $s->release_date }}</p>
          <a href="{{ route('admin.show', ['id'=>$s->id]) }}" class="btn btn-primary">Show</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection