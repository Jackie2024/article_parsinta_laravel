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
            'posts' => Post::latest()->paginate(5)
        ]);
    }

    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

    public function create(){
        return view ('posts.create');
    }

    public function store(Request $request){
        $post = new Post;
        $post->title = $request->title;
        $post->slug = \Str::slug($request->title);
        $post->body = $request->body;
        $post->save();

        return back();
    }
}
