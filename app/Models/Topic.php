<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'publisher_id', 'topicname', 'accepted'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function articles(){
        return $this->belongsToMany(Article::class, 'has_topics');
    }

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }
}
