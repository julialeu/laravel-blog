<?php


namespace App\Models;


class Post
{
    public static function find($slug)
    {
        base_path();
        if(! file_exists($path = resource_path("posts/{$slug}.html"))){
       return redirect('/');
    }

    return cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));

    }
}
