<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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
