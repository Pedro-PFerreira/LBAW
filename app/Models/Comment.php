<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Post
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'post_id', 'article_id', 'content'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

     public function article(){
        return $this->belongsTo(Article::class);
    }

    public function publisher(){
        $post = $this->post()->get()[0];
        return $post->publisher();
    }

    public function parent(){
        return $this->hasOne('Comment', 'parent_id');
    }

    public function answer(){
        return $this->hasMany('Comment', 'parent_id');
    }
}
