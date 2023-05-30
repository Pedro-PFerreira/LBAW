<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;

class Article extends Post{
    use HasFactory;
    
    protected $fillable = [
        'post_id', 'title', 'articledescription', 'body', 'accepted'
    ];

    public $timestamps = false;

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function topics(){
        return $this->belongsToMany(Topic::class);
    }

    public function publisher(){
        $post = $this->post()->get()[0];
        return $post->publisher();
    }
    
    public function favoritedBy(){
        return $this->belongsToMany(Publisher::class);
    }
}
