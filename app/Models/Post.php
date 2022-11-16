<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{
    public static function find($slug)
    {
        if (!file_exists($path = resource_path("posts/{$slug}.html"))) {
            throw new ModelNotFoundException();
        }

        //don't perform expensive operations such as file_get_contents() until you know you need to
        //if the content doesn't change much, you can cache it
        return cache()->remember("posts.{$slug}", 5, fn() => file_get_contents($path));

        // //use view() helper function to return a view
        // //the first argument is the name of the view
        // //the second argument is an array of data to pass to the view
    }
}