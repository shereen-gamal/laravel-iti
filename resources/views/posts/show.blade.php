@extends('layouts.app')

@section('title') show @endsection

@section('content')

<div class="card">
  <div class="card-header">
    Post Info
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p><b>Title:</b>Static title</p>
      <p><b>Description:</b>Static description</p>
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
      <p><b>Name:</b>Static name</p>
      <p><b>Email:</b>Static email</p>
      <p><b>Created At:</b>Static date and time</p>

    </blockquote>
  </div>
</div>

@endsection