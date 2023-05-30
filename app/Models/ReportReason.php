<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportReason extends Model
{
    use HasFactory;

    public function reports(){
        return $this->hasMany(UserReports::class);
    }
}
