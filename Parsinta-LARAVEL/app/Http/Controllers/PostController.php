<?php

namespace App\Http\Controllers;

use App\{Category, Post, Tag};
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }

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

        return view ('posts.create', [
                    'post' => new Post(),
                    'categories' => Category::get(),
                    'tags' => Tag::get()
        ]);
    }

    public function store(PostRequest $request){

        //ini panggil kelas PostRequest untuk validasi secara langsung

        //Cara 1
        // $post = new Post;
        // $post->title = $request->title;
        // $post->slug = \Str::slug($request->title);
        // $post->body = $request->body;
        // $post->save();

        //Cara 2 ini harus pakai fillable dan guarded
        // Post::create([
        //     'title' => $request->title,
        //     'slug' => \Str::slug($request->title),
        //     'body' => $request->body,

        // ]);

        // //Validate the field
        // $attr = request()->validate([
        //     'title' => 'required|min:3|max:10',
        //     'body' => 'required'
        // ]);

        //current user
        // dd(auth()->user());

        $attr = $request->all();
        //Assign title to the slug
        $attr['slug'] = \Str::slug(request('title'));
        $attr['category_id'] = request('category');
        dd(request()->all());
        //Create new post
        $post = auth()->user()->posts()->create($attr);

        $post->tags()->attach(request('tags'));

        // dd($post);
        session()->flash('success', 'The Post was successfully created!');
        return redirect('posts');
        // return back();
    }

    public function edit(Post $post){
        return view('posts.edit',[
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    public function update(Post $post){
        //Validate the field
        $attr = $this->validateRequest(); //ini cara kedua untuk validasi
        //cara pertama bisa pakai $request kayak di store
        $attr['category_id'] = request('category');
        $post->update($attr);
        $post->tags()->sync(request('tags'));

        session()->flash('success', 'The Post was successfully updated!');
        return redirect('posts');
    }

    public function validateRequest(){
        return request()->validate([
            'title' => 'required|min:3|max:10',
            'body' => 'required',
        ], [
            'title.required' => 'Title diperlukan'
        ]);
    }

    public function destroy(Post $post)
    {
        if(auth()->user()->is($post->author)){
            $post->tags()->detach();
            $post->delete();
            session()->flash("success", "Post successfully deleted!");
            return redirect('posts');
        }
    }
}
