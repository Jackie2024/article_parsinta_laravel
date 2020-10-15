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

    public function store(){
        // $post = new Post;
        // $post->title = $request->title;
        // $post->slug = \Str::slug($request->title);
        // $post->body = $request->body;
        // $post->save();

        // Post::create([
        //     'title' => $request->title,
        //     'slug' => \Str::slug($request->title),
        //     'body' => $request->body,

        // ]);

        //Validate the field
        $attr = request()->validate([
            'title' => 'required|min:3|max:10',
            'body' => 'required'
        ]);

        //Assign title to the slug
        $attr['slug'] = \Str::slug(request('title'));

        //Create new post
        Post::create($attr);

        session()->flash('success', 'The Post was successfully created!');
        return redirect('posts');
        // return back();
    }

    public function edit(Post $post){
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post){
        //Validate the field
         $attr = request()->validate([
            'title' => 'required|min:3|max:10',
            'body' => 'required'
        ]);

        $post->update($attr);
        session()->flash('success', 'The Post was successfully updated!');
        return redirect('posts');
    }
}
