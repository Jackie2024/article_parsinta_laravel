<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // return Post::get();
        // return Post::latestFirst(); -> manggil fungsi di kelas Post secara static
        // $posts = Post::get();
        // $posts = Post::paginate(5);
        // $posts = Post::simplePaginate(5);
        // return view('posts.index', compact('posts'));
        return view('posts.index', [
            'posts' => Post::paginate(5)
        ]);
    }

    public function show(Post $post){
        return view('posts.show', compact('post'));
    }
}
