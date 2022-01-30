@extends('layouts.app')

@section('title') show @endsection

@section('content')

<div class="card">
  <div class="card-header">
    Post Info
  </div>
 @foreach ($post as $item)
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p><b>Title:</b> {{$item->title}}</p>
      <p><b>Description:</b> {{$item->description}}</p>
    </blockquote>
  </div>  
</div>
<br>
<hr>
<br>
<div class="card">
  <div class="card-header">
    Post Creator Info
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p><b>Name:</b> {{$item->user->name}}</p>
      <p><b>Email:</b> {{$item->user->email}}</p>
      <p><b>Created At:</b> {{$item->created_at}}</p>
    </blockquote>
    @endforeach
  </div>
</div>


@endsection