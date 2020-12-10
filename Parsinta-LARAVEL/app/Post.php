<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'slug', 'body', 'category_id'];
    // protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // } untuk spesifikkan pada route yang diterima dari post itu slug
    public function scopelatestFirst(){
        return $this->latest()->first();
    }

    public function scopelatestPost(){
        return $this->latest()->get();
    }
    // Post::orderBy('created_at', 'asc')->get();
    // Post::latest()->limit(5)->get();
}
