<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    use HasFactory;

    public function reason(){
        return $this->belongsTo(ReportReason::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
