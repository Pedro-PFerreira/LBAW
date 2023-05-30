<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Publisher extends User{
    use HasFactory;

    public $timestamps = false;

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function articles(){
        return $this->hasManyThrough(Article::class, Post::class);
    }

    public function comments(){
        return $this->hasManyThrough(Comment::class, Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function favorites(){
        return $this->belongsToMany(Article::class);
    }
    
    public function profilepic(){
        return $this->hasOne(String::class);
    }
}

?>