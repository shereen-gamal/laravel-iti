<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::all();
        
        
        $carbon= new Carbon();
        return view('posts.index', [
            // 'allPosts' => $allPosts,
            'allPosts' => DB::table('posts')->paginate(8)
           

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
        $post = Post::all()->where('id',$postId);
        //query in db select * from posts where id = $postId
        return view('posts.show',[
            'post' => $post
        ]);
    }

    public function edit($id){
        $post = Post::all()->where('id',$id);
        return view('posts.edit',[
            'post' => $post
        ]);

    }

    public function update($id){
        $data = request()->all();
        DB::table('posts')->where('id',$id)->update([
            'title'=>$data['title'],
            'description'=>$data['description'],
        ]);
        
        return redirect()->route('posts.index');

    }

    public function destroy ($id){
        DB::table('posts')->where('id',$id)->delete();
        return redirect()->route('posts.index');
    }
}
