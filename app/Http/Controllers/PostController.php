<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $post = new Post();

        $carbon= new Carbon();
        return view('posts.index', [
            // 'allPosts' => $allPosts,
            'allPosts' => $post->paginate(6),
            
            
        ]);
    }

    public function create()
    {
        $users = User::all();

        return view('posts.create',[
            'users' => $users
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->all();
        $photo_exe = $data['photo']->getClientOriginalExtension();

        if($photo_exe =="png"|| $photo_exe=='jpg'){
            $fileName = time() . "." . $photo_exe;
            $path = 'images/posts';
            $data['photo']->move($path,$fileName);
        }
        
        
        Post::create([
            
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
            'slug'=>Str::slug($data['title'],'-'),
            'photo'=>isset($fileName)?$fileName:NULL,
          
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
        Validator::make($data,[
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],
            
        ])->validate();
           
        $post = new Post();
        $post->where('id',$id)->update([
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
