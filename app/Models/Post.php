<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Post extends Model{
    use HasFactory;

    protected $fillable = [
        'publisher_id', 'nlikes', 'ndislikes', 'ncomments'
    ];

    public function concrete(){
        $return = $this->hasOne(Article::class)->get();
        if($return->isEmpty()){
            $return = $this->hasOne(Comment::class)->get();
        }
        return $return;
    }

    public function article(){
        return $this->hasOne(Article::class)->get()[0];
    }

    public function comment(){
        return $this->hasOne(Comment::class)->get()[0];
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }

    public function reports(){
        return $this->hasMany(UserReport::class);
    }

}
