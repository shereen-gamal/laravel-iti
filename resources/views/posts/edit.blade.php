@extends('layouts.app')

@section('title') edit @endsection

@section('content')

<main class="py-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
</main>

@foreach ($post as $item)

<br><br>
<form method="POST" action="{{route('posts.update',$item->id)}}">

@csrf  
@method('PUT')     
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{$item->title}}">
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea  name='description' class="form-control" id="exampleFormControlTextarea1" rows="3" >{{$item->description}}</textarea>  
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
                <select name="post_creator" class="form-control">
                   <option value="{{$item->id}}">{{$item->user->name}}</option>
                </select>
            </div>
            @endforeach
            
            <button  class="btn btn-success">Update Post</button>
        </form>
        <br><br><br><hr> <br><br><br>
@endsection
