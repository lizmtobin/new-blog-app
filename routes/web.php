<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Spatie\YamlFrontMatter\YamlFrontMatter;

//use Symfony\Component\Yaml\Yaml;

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
    $posts = collect(File::files(resource_path("posts")))
        ->map(fn($file) => YamlFrontMatter::parseFile($file))
        ->map(function ($document) {

            return new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            );
        }
        )
        ->sortByDesc('date');

    return view('posts', [
        'posts' => $posts
    ]);

});

Route::get('/posts/{post}', function ($slug) {

    return view('post', [
        'post' => Post::find($slug)
    ]);
});
//can use sql like syntax to get the post with certain syntax
//->whereAlpha('post', '[A-z_\-]+');