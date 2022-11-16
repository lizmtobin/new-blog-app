<?php

use Illuminate\Support\Facades\Route;

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
    return view('posts');
});

Route::get('/posts/{post}', function ($slug){
    $path = __DIR__ . "/../resources/posts/{$slug}.html";
    if(!file_exists($path)){
        return redirect('/');
    }

    //don't perform expensive operations such as file_get_contents() until you know you need to
    //if the content doesn't change much, you can cache it
    $post = cache()->remember("posts.{$slug}", 5, fn() => file_get_contents($path));

    //use view() helper function to return a view
    //the first argument is the name of the view
    //the second argument is an array of data to pass to the view
    $post = file_get_contents($path);
    return view('post', [
        'post' => $post
    ]);
});
//can use sql like syntax to get the post with certain syntax
//->whereAlpha('post', '[A-z_\-]+');