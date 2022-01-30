<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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
        return view('posts.create');
    }

    public function store()
    {
        // dd('test'); any logic after dd won't be executed
        //the logic to store post in the db
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
