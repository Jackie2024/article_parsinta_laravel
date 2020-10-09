@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            <h4>All Post</h4>
            <hr>
        </div>
        <div>
            <a href="/posts/create" class ="btn btn-primary">New Post</a>
        </div>

    </div>
    <div class="row">
        @forelse ($posts as $post)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    {{$post->title}}
                </div>
                <div class="card-body">
                    <div>
                        {{-- {{Str::limit($post->body, 100)}} --}}
                        {{Str::limit($post->body, 100, '')}}
                    </div>
                    <a href="/posts/{{$post->slug}}">Read more</a>
                </div>
                <div class="card-footer">
                    {{-- Published on {{$post->created_at->format("D F, Y")}} --}}
                    Published on {{$post->created_at->diffForHumans()}}
                    {{-- m untuk tampilkan angka bulan, d buat tampilkan tanggal, F full month--}}
                </div>
            </div>
        </div>
        @empty
            <div class="col-md-6">
                <div class="alert alert-info">
                    There are no posts
                </div>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        {{$posts->links()}}
    </div>
</div>
@endsection
