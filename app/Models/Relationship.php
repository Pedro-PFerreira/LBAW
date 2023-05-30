<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publishers;

class Relationship extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'publisher1_id', 'publisher2_id', 'reltype' 
    ];

    public function publishers(){
        return $this->hasMany('App\Models\Publisher');
    }

}
