@extends('layouts.app')

@section('title')Index @endsection

@section('content')
        <div class="text-center">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
        </div>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">title-slug</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>

             @foreach ($posts as $post)
              <tr>
              <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ isset($post->user) ? $post->user->name : 'Not Found' }}</td>
                {{-- @dd($post->created_at) carbon object --}}
                <td>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d')}}</td>
                <td>{{$post->slug}}</td>
                <td>
                 
                    <a href="{{ route('posts.show',[$post->id])}}" class="btn btn-primary">View</a>
                    <a href="{{ route('posts.edit',[$post->id])}}" class="btn btn-success">Edit</a>

                    <a href="posts/{{$post->id}}" class="btn btn-danger" onclick="
                      var result = confirm('Are you sure you want to delete this record?');
                
                      if(result){
                        event.preventDefault();
                        document.getElementById('delete-form-{{$post->id}}').submit();
                        }"> Delete
                   </a>
                  <form method="POST" id="delete-form-{{$post->id}}" action="{{route('posts.destroy', [$post->id])}}">
                      {{csrf_field()}}
                      <input type="hidden" name="_method" value="DELETE">
                  </form>

                    <!-- <a href="{{ route('posts.destroy',[$post->id])}}" class="btn btn-danger">Delete</a> -->
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

 {{ $posts->links() }}


 <br><br><hr><br>
@endsection
    