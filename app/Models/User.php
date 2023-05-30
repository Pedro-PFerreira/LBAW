<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The cards this user owns.
     */
     public function cards() {
      return $this->hasMany('App\Models\Card');
    }

    /**
     * The posts this user have.
     */
    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function publisher(){
        return $this->hasOne('App\Models\Publisher');
    }
}
