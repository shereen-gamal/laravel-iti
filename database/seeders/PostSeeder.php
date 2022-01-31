<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()->count(500)->hasPosts(1)->create();

        DB::table('posts')->insert([
            'title' => Str::random(20),
            'description' => Str::random(100),
            'user_id'=> 3
            
        ]);
    
    }
}
