<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('hello', function () {
    $name = 'mohamed';
    $age = 25;
    return view('hello',[
        'name' => $name,
    ]);
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::delete('/posts/post/{post}',[PostController::class,'destroy'])->name('posts.destroy')->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');
Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update')->middleware('auth');
Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit')->middleware('auth');
Route::post('/posts',[PostController::class, 'store'])->name('posts.store')->middleware('auth');


Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');

Route::get('/auth/callback', function () {

    $githubUser = Socialite::driver('github')->user();

    $user = User::where('github_id', $githubUser->id)->first();

    if ($user) {
        $user->update([
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    } else {
        $user = User::create([
            'name' => $githubUser->nickname,
            'password'=>'123456789',
            'email' => $githubUser->email."3",
            'github_id' => $githubUser->id,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }

    Auth::login($user);
    return redirect('/posts');
});


Route::get('/google/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');

Route::get('/google/auth/callback', function () {

    $googleuser = Socialite::driver('google')->user();
    $user = User::create([
        'name' => $googleuser->name,
        'email' => $googleuser->email.'2',
        'password'=> $googleuser->id,
    ]);

    Auth::login($user);
    return redirect('/posts');

    dd($user);
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
