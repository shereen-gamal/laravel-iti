<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function index (){
        $posts = Post ::with('user')->get();
        return PostResource::collection($posts);
    }

    public function show ($id){
        $post = Post::find($id);

        return new PostResource($post) ;
    }
    public function store(){
        $data =request()->all();
        $post = Post::create([
            
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
            'slug'=>Str::slug($data['title'],'-'),
            'photo'=>isset($fileName)?$fileName:NULL,
          
        ]);
        return new PostResource($post);
    }    
}
