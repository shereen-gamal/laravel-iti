<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::all();

        return view('posts.index', [
            'allPosts' => $allPosts
        ]);
    }

    public function create()
    {
        $users = User::all();

        return view('posts.create',[
            'users' => $users
        ]);
    }

    public function store()
    {
        $data = request()->all();
        
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
          
        ]);
        return redirect()->route('posts.index');
        
    }

    public function show($postId)
    {
        //query in db select * from posts where id = $postId
        return view('posts.show');
    }

    public function edit($id){
        return view('posts.edit');

    }

    public function update($id){
        return redirect()->route('posts.index');

    }
    public function destroy ($id){
        return redirect()->route('posts.edit');
    }
}
