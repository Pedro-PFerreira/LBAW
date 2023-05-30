<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'publisher_id', 'post_id'
    ];

    public $timestamps = false;
}
